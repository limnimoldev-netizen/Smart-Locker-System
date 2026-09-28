<?php

namespace App\Models;

use App\Models\Locker;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Location extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'location_id',
        'location_name',
        'address',
        'opening_hours',
        'capacity',
        'current_locker_count',
        'status',
        'map_url',
    ];

    public function lockers() {
        return $this->hasMany(Locker::class, 'location_id', 'location_id');
    }

    public function maintenances() {
        return $this->hasMany(Maintenance::class, 'location_id', 'location_id');
    }
}
