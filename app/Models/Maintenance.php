<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $fillable = [
        'locker_id',
        'description',
        'status',
        'priority',
    ];

    public function locker()
    {
        return $this->belongsTo(Locker::class);
    }
}
