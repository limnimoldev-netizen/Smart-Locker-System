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
    protected $table = 'lockers';

    protected $fillable = [
        'locker_number',
        'location_id',
        'type',
        'status',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

}
