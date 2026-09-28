<?php

namespace App\Models;

use App\Enums\UserStatus;
use App\Models\Locker;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id';
    public $incrementing  = false;
    protected $keyType    = 'string';
    
    protected $fillable = [
        'user_id',
        'user_code',
        'username',
        'full_name',
        'email',
        'phone',
        'status'
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
