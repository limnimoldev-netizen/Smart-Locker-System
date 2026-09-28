<?php

namespace App\Models;

use App\Enums\MaintenanceStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Maintenance extends Model
{
    protected $casts = [
        'status' => MaintenanceStatus::class,
    ];

    use HasFactory, Notifiable;

    protected $primaryKey = 'maintenance_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function locker() {
        return $this->belongsTo(Locker::class, 'locker_id', 'locker_id');
    }

    public function location() {
        return $this->belongsTo(Location::class, 'location_id', 'location_id');
    }

    public function reporter() {
        return $this->belongsTo(User::class, 'reported_by', 'user_id');
    }

    protected $fillable = [
        'maintenance_id',
        'locker_id',
        'location_id',
        'issue_type',
        'priority',
        'status',
        'reported_by',
        'reported_at',
        'resolved_at',
    ];
}
