<?php

namespace App\Enums;

enum MaintenanceStatus: string
{
    case Open = 'open';
    case InProgress = 'in_progress';
    case Resolved = 'resolved';
    case Closed = 'closed';

    public function label(): string
    {
        return match ($this) {
            self::Open => 'Open',
            self::InProgress => 'In Progress',
            self::Resolved => 'Resolved',
            self::Closed => 'Closed',
        };
    }

    public function isOpen(): bool {
        return in_array($this, [
            self::Open,
            self::InProgress,
        ], true);
    }

    public function isFinal(): bool {
        return in_array($this, [
            self::Resolved,
            self::Closed,
        ], true);
    }

    public function blocksLocker(): bool {
        return in_array($this, [
            self::Open,
            self::Resolved,
            self::InProgress,
        ], true);
    }

    public function color(): string {
        return match ($this) {
            self::Open => 'text-red-500',
            self::InProgress => 'text-blue-500',
            self::Resolved => 'text-green-500',
            self::Closed => 'text-gray-500',
        };
    }

    public static function values(): array {
        return array_column(self::cases(), 'value');
    }
}
