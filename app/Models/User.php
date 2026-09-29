<?php

namespace App\Models;

use App\Enums\UserStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'status',
    ];

    protected $casts = [
        'status' => UserStatus::class,
    ];

    public function lockers() {
        return $this->hasMany(Locker::class, 'user_id', 'user_id');
    }

    public function reportedMaintenances() {
        return $this->hasMany(Maintenance::class, 'reported_by', 'user_id');
    }
}
