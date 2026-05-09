<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'member_id', 'date', 'check_in', 'check_out'
    ];

    protected $table = 'attendances';

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}