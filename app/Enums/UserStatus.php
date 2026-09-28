<?php

namespace App\Enums;

enum UserStatus: string
{
    case Active = 'Active';
    case Inactive = 'Inactive';
    case Expired = 'Expired';
    case Blacklisted = 'Blacklisted';
    case Pending = 'Pending';
    case Suspended = 'Suspended';
    case Banned = 'Banned';
    case Locked = 'Locked';

    public function label(): string
    {
        return match ($this) {
            self::Active => 'Active',
            self::Inactive => 'Inactive',
            self::Expired => 'Expired',
            self::Blacklisted => 'Blacklisted',
            self::Pending => 'Pending',
            self::Suspended => 'Suspended',
            self::Banned => 'Banned',
            self::Locked => 'Locked',
        };
    }

    public function canAccessLocker(): bool
    {
        return $this === self::Active;
    }

    public function canLogin(): bool 
    {
        return in_array($this, [
            self::Active,
            self::Inactive,
        ], true);
    }

    public function isReversible(): bool
    {
        return in_array($this, [
            self::Pending,
            self::Banned,
            self::Suspended,
            self::Inactive,
            self::Locked,
        ], true);
    }

    public function color(): string
    {
        return match ($this) {
            self::Active => 'green',
            self::Inactive => 'gray',
            self::Expired => 'amber',
            self::Blacklisted => 'black',
            self::Pending => 'yellow',
            self::Suspended => 'orange',
            self::Banned => 'red',
            self::Locked => 'red',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}