<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locker extends Model
{
    protected $table = 'lockers';

    protected $fillable = [
        'location_id',
        'type',
        'status',
        'locker_number',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

}
