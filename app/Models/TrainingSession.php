<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingSession extends Model
{
    protected $fillable = [
        'trainer_id', 'member_id', 'title',
        'notes', 'session_date', 'start_time',
        'end_time', 'status'
    ];

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}