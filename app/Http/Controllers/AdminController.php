<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task; // Wajib dipanggil agar bisa mengambil data tugas

class AdminController extends Controller
{
    public function index()
    {
        // Ambil semua tugas untuk ditampilkan di tabel
        $tasks = Task::all();
        
        // Arahkan ke file tampilan 'admin/dashboard.blade.php'
        return view('admin.dashboard', compact('tasks'));
    }
}