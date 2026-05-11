<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutPlan extends Model
{
    protected $fillable = [
        'trainer_id', 'member_id', 'title',
        'description', 'difficulty', 'start_date',
        'end_date', 'status'
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