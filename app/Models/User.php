<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role', 'profile_photo', 'phone', 'age'])]
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

    public function member()
{
    return $this->hasOne(Member::class);
}

public function isAdmin()
{
    return $this->role === 'admin';
}

public function isTrainer()
{
    return $this->role === 'trainer';
}

public function isMember()
{
    return $this->role === 'member';
}

public function workoutPlans()
{
    return $this->hasMany(WorkoutPlan::class, 'trainer_id');
}

public function trainingSessions()
{
    return $this->hasMany(TrainingSession::class, 'trainer_id');
}

public function notifications()
{
    return $this->hasMany(Notification::class);
}

public function unreadNotifications()
{
    return $this->hasMany(Notification::class)->where('is_read', false);
}
}
