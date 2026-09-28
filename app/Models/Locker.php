<?php

namespace App\Models;

use App\Enums\LockerStatus;
use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Locker extends Model
{
    /** @use HasFactory<\Database\Factories\LockerFactory> */
    use HasFactory, Notifiable;

    protected $primaryKey = 'locker_id';
    public $incrementing  = false;
    protected $keyType    = 'string';

    protected $casts = [
        'status' => LockerStatus::class,
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    
    public function location() {
        return $this->belongsTo(Location::class, 'location_id', 'location_id');
    }

    public function openMaintenances() {
        return $this->hasMany(Maintenance::class, 'locker_id', 'locker_id')->whereIn('status', ['open', 'in_progress']);
    }
    
    public function getRouteKeyName()
    {
        return 'locker_id';
    }
}
