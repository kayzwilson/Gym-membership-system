<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'gender',
        'dob',
    ];

    protected $casts = [
        'dob' => 'date',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}