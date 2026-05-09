<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipPlan extends Model
{
    protected $fillable = [
        'name', 'description', 'price',
        'duration_days', 'status'
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}