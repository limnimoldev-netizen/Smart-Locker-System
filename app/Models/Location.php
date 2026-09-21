<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';

    protected $fillable = [
        'name',
        'address',
        'latitude',
        'longitude',
        'map_url',
        'status',
    ];

   
}
