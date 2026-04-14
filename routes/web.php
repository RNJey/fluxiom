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
    Route::get('/history', [App\Http\Controllers\TaskController::class, 'history'])->name('history');
    Route::get('/history/pdf', [App\Http\Controllers\TaskController::class, 'downloadPdf'])->name('history.pdf');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

Route::get('/task/{id}', [TaskController::class, 'show'])->name('task.show');


require __DIR__.'/auth.php';