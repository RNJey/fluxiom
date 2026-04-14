<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Kolom apa saja yang boleh diisi
    protected $fillable = ['title', 'description', 'xp_reward', 'parent_id'];

    // Relasi ke User
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('status')->withTimestamps();
    }

    // Relasi ke "Induk" (Syarat sebelum tugas ini terbuka)
    public function parent()
    {
        return $this->belongsTo(Task::class, 'parent_id');
    }

    // Relasi ke "Anak" (Cabang tugas selanjutnya)
    public function children()
    {
        return $this->hasMany(Task::class, 'parent_id');
    }
}