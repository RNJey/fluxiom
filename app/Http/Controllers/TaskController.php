<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Http;


class TaskController extends Controller
{
    public function index()
    {
        // Hanya ambil tugas MILIK SAYA SENDIRI
        $tasks = Task::where('user_id', auth()->id())
                     ->whereNull('parent_id')
                     ->with('children.children')
                     ->get();

        return view('dashboard', compact('tasks'));
    }

    public function complete($id)
    {
        // Pastikan hanya bisa menyelesaikan tugas milik sendiri
        $task = Task::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        
        $task->update(['status' => 'completed']);

        foreach ($task->children as $child) {
            $child->update(['status' => 'available']);
        }

        return redirect()->back();
    }

    public function autoCreate()
    {
        return view('auto_create');
    }

    public function autoStore(Request $request)
{
    $request->validate(['syllabus' => 'required|string']);
    $apiKey = env('GEMINI_API_KEY'); 

    $prompt = "Ubah silabus ini menjadi JSON Skill Tree. 
    Aturan:
    1. Buat 5 materi.
    2. WAJIB ada hierarki: Materi 1 adalah akar, Materi 2 & 3 syaratnya Materi 1, Materi 4 syaratnya Materi 2, dst.
    3. Struktur JSON: [{\"title\":\"...\", \"description\":\"...\", \"xp_reward\":100, \"is_child_of\":\"JUDUL_PARENT_NYA\"}].
    4. Untuk materi pertama, 'is_child_of' wajib dikosongkan (\"\").";

    try {
        $apiVersion = 'v1beta';
        $model = 'gemini-2.5-flash'; // Gunakan model yang berhasil di tempat Anda
        $url = "https://generativelanguage.googleapis.com/{$apiVersion}/models/{$model}:generateContent?key=" . trim($apiKey);

        $response = Http::withHeaders(['Content-Type' => 'application/json'])->post($url, [
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

            // LOGIKA PENYIMPANAN DATA (PENTING!)
            if (json_last_error() === JSON_ERROR_NONE && is_array($tasks)) {
                $insertedTasks = [];
                $userId = auth()->id();

                // 1. Simpan semua materi baru ke database
                foreach ($tasks as $taskData) {
                    $newTask = Task::create([
                        'user_id'   => $userId,
                        'title'     => $taskData['title'],
                        'description' => $taskData['description'],
                        'xp_reward' => $taskData['xp_reward'] ?? 100,
                        'status'    => 'locked', // Semua terkunci dulu
                        'parent_id' => null,
                    ]);
                    $insertedTasks[$taskData['title']] = $newTask; 
                }

                // 2. Hubungkan relasi (Parent-Child)
                foreach ($tasks as $taskData) {
                    $currentTask = $insertedTasks[$taskData['title']];
                    
                    if (!empty($taskData['is_child_of']) && isset($insertedTasks[$taskData['is_child_of']])) {
                        $parentTask = $insertedTasks[$taskData['is_child_of']];
                        $currentTask->update(['parent_id' => $parentTask->id]);
                    } else {
                        // Jika tidak punya parent, berarti materi pembuka. Set jadi Available!
                        $currentTask->update(['status' => 'available']);
                    }
                }

                return redirect()->route('dashboard');
            }

            return back()->withErrors(['Gagal memformat data AI.']);
        }
        
        return back()->withErrors(['API Google Error: ' . $response->status()]);

    } catch (\Exception $e) {
        return back()->withErrors(['Error: ' . $e->getMessage()]);
    }
    }
}