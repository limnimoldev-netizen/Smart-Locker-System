<?php

namespace App\Models;

use App\Enums\MaintenanceStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

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
