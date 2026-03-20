<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

// Saat web dibuka, panggil fungsi index di TaskController
Route::get('/', [TaskController::class, 'index']);

// Tambahkan baris ini untuk menangani aksi tombol "Selesaikan Quest"
Route::post('/task/{id}/complete', [TaskController::class, 'complete'])->name('task.complete');