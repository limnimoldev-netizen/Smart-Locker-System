<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LockerUsage extends Model
{
    protected $fillable = [
        'user_id',
        'locker_id',
        'started_at',
        'release_at',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function locker()
    {
        return $this->belongsTo(Locker::class);
    }
}
