<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task; // Pastikan ini ada agar Laravel mengenali model Task

class TaskSeeder extends Seeder
{
    public function run()
{
    // Level 1: Start
    $start = Task::create([
        'title' => 'Logika & Algoritma Dasar',
        'description' => 'Gerbang awal menjadi Engineer. Memahami alur pikir mesin.',
        'xp_reward' => 50, 'status' => 'available'
    ]);

    // Level 2: Penentuan Minat
    $web = Task::create([
        'title' => 'Front-End Foundation',
        'description' => 'Seni membangun antarmuka web yang interaktif.',
        'xp_reward' => 100, 'status' => 'locked', 'parent_id' => $start->id
    ]);

    $data = Task::create([
        'title' => 'Statistika & Python',
        'description' => 'Dasar pengolahan data untuk kecerdasan buatan.',
        'xp_reward' => 100, 'status' => 'locked', 'parent_id' => $start->id
    ]);

    // Level 3: Spesialisasi
    Task::create([
        'title' => 'Laravel Mastery',
        'description' => 'Membangun sistem backend skala industri.',
        'xp_reward' => 250, 'status' => 'locked', 'parent_id' => $web->id
    ]);

    Task::create([
        'title' => 'Mobile Dev (Flutter)',
        'description' => 'Membuat aplikasi Android & iOS dalam satu kode.',
        'xp_reward' => 250, 'status' => 'locked', 'parent_id' => $web->id
    ]);

    Task::create([
        'title' => 'Machine Learning',
        'description' => 'Melatih model AI untuk prediksi masa depan.',
        'xp_reward' => 300, 'status' => 'locked', 'parent_id' => $data->id
    ]);
    
    }

}