<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        // Ambil "Akar" (tugas yang tidak punya parent) 
        // beserta anak-anaknya dan cucu-cucunya.
        $tasks = Task::whereNull('parent_id')->with('children.children')->get();
        
        // Kirim datanya ke halaman bernama 'fluxiom'
        return view('fluxiom', compact('tasks'));
    }

    public function complete($id)
    {
        // 1. Cari tugas yang di-klik
        $task = Task::findOrFail($id);
        
        // 2. Ubah statusnya jadi selesai
        $task->status = 'completed';
        $task->save();

        // 3. Cari anak-anak cabangnya, ubah jadi available (terbuka)
        foreach ($task->children as $child) {
            $child->status = 'available';
            $child->save();
        }

        // 4. Kembali ke halaman utama
        return redirect()->back();
    }
}