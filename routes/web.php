<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Halaman setelah login SEKARANG diarahkan ke TaskController (Skill Tree)
// Semua aktivitas sekarang ada di Dashboard User
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');
    Route::post('/task/{id}/complete', [TaskController::class, 'complete'])->name('task.complete');
    
    // Pastikan dua baris ini benar-benar ada dan persis seperti ini:
    Route::get('/dashboard/auto', [TaskController::class, 'autoCreate'])->name('tasks.autoCreate');
    Route::post('/dashboard/auto', [TaskController::class, 'autoStore'])->name('tasks.autoStore');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';