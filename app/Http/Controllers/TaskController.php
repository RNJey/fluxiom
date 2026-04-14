<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Http;


class TaskController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Ambil semua AKAR (parent_id = null)
        $allRoots = Task::where('user_id', $userId)
                        ->whereNull('parent_id')
                        ->get();

        $activeTasks = [];
        $historyTasks = [];

        foreach ($allRoots as $root) {
            // Cek apakah di dalam cabang ini masih ada tugas yang belum 'completed'
            $hasUnfinished = Task::where('user_id', $userId)
                                 ->where(function($query) use ($root) {
                                     $query->where('id', $root->id)
                                           ->orWhere('parent_id', $root->id); // Logika sederhana untuk kedalaman 1-2 level
                                 })
                                 ->where('status', '!=', 'completed')
                                 ->exists();

            if ($hasUnfinished) {
                $activeTasks[] = $root;
            } else {
                $historyTasks[] = $root;
            }
        }

        // Cek apakah user sudah menyelesaikan semua tugas di database
        $totalTasks = Task::where('user_id', $userId)->count();
        $unfinishedTasks = Task::where('user_id', $userId)->where('status', '!=', 'completed')->count();
        $isAllCompleted = ($totalTasks > 0 && $unfinishedTasks === 0);

        return view('dashboard', compact('activeTasks', 'historyTasks', 'isAllCompleted'));
    }

    public function complete(Request $request, $id)
    {
        $task = Task::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        
        // Cek Jawaban Kuis
        if ($request->has('answer')) {
            if ($request->answer !== $task->quiz_answer) {
                return redirect()->back()->with('error', 'Jawaban salah! Silakan baca materi dengan lebih teliti.');
            }
        }

        // Jika benar / tidak ada kuis, lanjutkan proses Level Up
        $task->update(['status' => 'completed']);
        foreach ($task->children as $child) {
            $child->update(['status' => 'available']);
        }

        $user = auth()->user();
        $user->xp += $task->xp_reward;
        $newLevel = floor($user->xp / 500) + 1;
        
        if ($newLevel > $user->level) {
            $user->level = $newLevel;
            session()->flash('level_up', '🎉 LEVEL UP! Anda sekarang mencapai Level ' . $newLevel . '!');
        }
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Jawaban Benar! +' . $task->xp_reward . ' XP Diperoleh!');
    }

    public function autoCreate()
    {
        return view('auto_create');
    }

    public function autoStore(Request $request)
{
    $request->validate(['syllabus' => 'required|string']);
    $apiKey = env('GEMINI_API_KEY'); 

    $prompt = "Tugas: PECAH teks masukan menjadi JSON Skill Tree Edukatif dengan BEBERAPA JALUR UTAMA.
        
        Aturan WAJIB:
        1. JALUR UTAMA (AKAR): Buat 3 Topik Utama (is_child_of kosong: \"\").
        2. MATERI TURUNAN: Tiap Topik Utama punya 7 materi turunan berantai.
        3. KONTEN & KUIS: Untuk setiap materi, buatkan 'content' (2 paragraf + referensi link), lalu buat 5 pertanyaan kuis pilihan ganda untuk menguji pemahaman materi tersebut.
        4. Struktur JSON WAJIB seperti ini: 
        [
            {
                \"title\": \"...\", 
                \"description\": \"...\", 
                \"content\": \"...\", 
                \"quiz_question\": \"Apa kepanjangan dari HTML?\",
                \"quiz_options\": [\"Hyper Text Markup Language\", \"Hyper Tool Multi Language\", \"Home Text Markup Language\"],
                \"quiz_answer\": \"Hyper Text Markup Language\",
                \"xp_reward\": 100, 
                \"is_child_of\": \"...\"
            }
        ]
        5. Format: Murni array JSON tanpa tag markdown. Kunci jawaban (quiz_answer) HARUS sama persis dengan salah satu teks di quiz_options.
        
        Teks Masukan: " . $request->syllabus;

    try {
        $apiVersion = 'v1beta';
        $model = 'gemini-flash-latest';
        $url = "https://generativelanguage.googleapis.com/{$apiVersion}/models/{$model}:generateContent?key=" . trim($apiKey);

        $response = Http::withHeaders(['Content-Type' => 'application/json'])
        ->timeout(120)
        ->post($url, [
            'contents' => [['parts' => [['text' => $prompt]]]]
        ]);

        if ($response->successful()) {
            $result = $response->json();
            $text = $result['candidates'][0]['content']['parts'][0]['text'] ?? '';

            // Pembersihan JSON
            $cleanJson = trim($text);
            $cleanJson = str_replace(['```json', '```', 'json'], '', $cleanJson);
            if (preg_match('/\[[\s\S]*\]/', $cleanJson, $matches)) {
                $cleanJson = $matches[0];
            }

            $tasks = json_decode($cleanJson, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($tasks)) {
                $insertedTasks = [];
                $userId = auth()->id();

                // 1. Simpan materi termasuk kuis
                    foreach ($tasks as $taskData) {
                        $newTask = Task::create([
                            'user_id'       => $userId,
                            'title'         => $taskData['title'],
                            'description'   => $taskData['description'],
                            'content'       => $taskData['content'] ?? 'Materi kosong.',
                            'quiz_question' => $taskData['quiz_question'] ?? null,
                            'quiz_options'  => isset($taskData['quiz_options']) ? json_encode($taskData['quiz_options']) : null,
                            'quiz_answer'   => $taskData['quiz_answer'] ?? null,
                            'xp_reward'     => $taskData['xp_reward'] ?? 100,
                            'status'        => 'locked',
                            'parent_id'     => null,
                        ]);
                        $insertedTasks[$taskData['title']] = $newTask; 
                    }

                // 2. Hubungkan relasi
                foreach ($tasks as $taskData) {
                    $currentTask = $insertedTasks[$taskData['title']];
                    if (!empty($taskData['is_child_of']) && isset($insertedTasks[$taskData['is_child_of']])) {
                        $parentTask = $insertedTasks[$taskData['is_child_of']];
                        $currentTask->update(['parent_id' => $parentTask->id]);
                    } else {
                        $currentTask->update(['status' => 'available']);
                    }
                }

                return redirect()->route('dashboard');
            }
            return back()->withErrors(['Gagal memformat materi AI.']);
        }
        return back()->withErrors(['API Error: ' . $response->status()]);

    } catch (\Exception $e) {
        return back()->withErrors(['Error: ' . $e->getMessage()]);
    }
}

    public function show($id) {
    $task = Task::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
    
    // Pastikan user tidak bisa buka materi yang statusnya masih 'locked'
    if($task->status == 'locked') {
        return redirect()->route('dashboard')->with('error', 'Quest ini masih terkunci!');
    }

    return view('task_detail', compact('task'));
}
}