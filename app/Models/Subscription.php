<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'member_id', 'membership_plan_id', 'start_date', 'end_date',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function plan()
    {
        return $this->belongsTo(MembershipPlan::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function getStatusAttribute(): string
    {
        return $this->end_date->isFuture() ? 'Active' : 'Expired';
    }
}