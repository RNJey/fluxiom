<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Ambil data user yang sedang login

        // 1. Jika user baru pertama kali login dan belum punya progress tugas
        if ($user->tasks()->count() == 0) {
            $allTasks = Task::all();
            foreach ($allTasks as $task) {
                // Yang tidak punya parent (Akar) statusnya available, sisanya locked
                $status = is_null($task->parent_id) ? 'available' : 'locked';
                $user->tasks()->attach($task->id, ['status' => $status]);
            }
        }

        // 2. Ambil master pohon tugasnya
        $tasks = Task::whereNull('parent_id')->with('children.children')->get();

        // 3. Ambil daftar status KHUSUS untuk user yang sedang login
        // Hasilnya berupa array: [id_tugas => 'statusnya']
        $userStatuses = $user->tasks()->pluck('status', 'task_id')->toArray();

        // 4. Kirim ke halaman dashboard bawaan Laravel Breeze
        return view('dashboard', compact('tasks', 'userStatuses'));
    }

    public function complete($id)
    {
        $user = auth()->user();

        // 1. Ubah tugas ini jadi selesai KHUSUS untuk user ini
        $user->tasks()->updateExistingPivot($id, ['status' => 'completed']);

        // 2. Cari anak-anak dari tugas ini, dan buka kuncinya (available)
        $task = Task::findOrFail($id);
        foreach ($task->children as $child) {
            $user->tasks()->updateExistingPivot($child->id, ['status' => 'available']);
        }

        return redirect()->back();
    }
}