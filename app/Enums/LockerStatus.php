<?php 

namespace App\Enums;

enum LockerStatus: string {
    case Available    = 'available';
    case Occupied     = 'occupied';
    case Reserved     = 'reserved';
    case Maintenance  = 'maintenance';
    case OutOfService = 'out_of_service';
    case Disabled     = 'disabled';
    case Cleaning     = 'cleaning';

    public function label(): string
    {
        return match ($this) {
            self::Available    => 'Available',
            self::Occupied     => 'Occupied',
            self::Reserved     => 'Reserved',
            self::Maintenance  => 'Under Maintenance',
            self::OutOfService => 'Out of Service',
            self::Disabled     => 'Disabled',
            self::Cleaning     => 'Cleaning',
        };
    }

    public function canCheckIn(): bool
    {
        return $this === self::Available;
    }

    public function isUsable(): bool
    {
        return in_array($this, [
            self::Available,
            self::Occupied,
            self::Reserved,
        ], true);
    }

    public function isFree(): bool
    {
        return $this === self::Available;
    }

    public function color(): string
    {
        return match ($this) {
            self::Available    => 'text-green-500 bg-green-100 rounded-full',
            self::Occupied     => 'text-blue-500 bg-blue-100 rounded-full',
            self::Reserved     => 'text-purple-500 bg-purple-100 rounded-full',
            self::Maintenance  => 'text-orange-500 bg-orange-100 rounded-full',
            self::OutOfService => 'text-red-500 bg-red-100 rounded-full',
            self::Disabled     => 'text-gray-500 bg-gray-100 rounded-full',
            self::Cleaning     => 'text-yellow-500 bg-yellow-100 rounded-full',
        };
    }

    public static function values(): array {
        return array_column(self::cases(), 'value');
    }
}