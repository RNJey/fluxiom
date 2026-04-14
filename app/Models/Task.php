<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // Tambahkan user_id dan status
    protected $fillable = ['user_id', 'title', 'description', 'xp_reward', 'status', 'parent_id'];

    public function children()
    {
        return $this->hasMany(Task::class, 'parent_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}