<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // Tambahkan 'content' ke dalam array ini!
    protected $fillable = [
        'user_id', 
        'title', 
        'description', 
        'content',
        'quiz_question', 
        'quiz_options', 
        'quiz_answer',
        'xp_reward', 
        'status', 
        'parent_id'
    ];

    public function children()
    {
        return $this->hasMany(Task::class, 'parent_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}