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
        'name',
        'address',
        'type',
        'latitude',
        'longitude',
        'map_url',
        'status',
    ];

    public function lockers()
    {
        return $this->hasMany(Locker::class);
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }
}
