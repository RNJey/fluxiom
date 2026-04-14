<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'xp',   
        'level',
        'profile_photo',
    ];

    // Sistem Gelar Otomatis berdasarkan Level
    public function getGelarAttribute()
    {
        $level = $this->level ?? 1;
        
        if ($level < 5) return 'Novice Trainee';
        if ($level < 10) return 'Junior Engineer';
        if ($level < 20) return 'Mid-Level Developer';
        if ($level < 35) return 'Senior Tech Lead';
        return 'System Architect';
    }

    // Relasi ke progress tugas user
    public function tasks()
    {
        return $this->belongsToMany(Task::class)->withPivot('status')->withTimestamps();
    }
}
