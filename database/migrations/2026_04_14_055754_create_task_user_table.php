<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('task_user', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ID Pengguna
        $table->foreignId('task_id')->constrained()->onDelete('cascade'); // ID Tugas
        $table->enum('status', ['locked', 'available', 'completed'])->default('locked'); // Status per user
        $table->timestamps();
    });
}
};
