<?php

namespace App\Enums;

enum MaintenanceIssueType: string 
{
    case LockJammed = 'lock_jammed';
    case LockBroken = 'lock_broken';
    case DoorWontOpen = 'door_wont_open';
    case DoorWontClose = 'door_wont_close';
    case DoorDamaged = 'door_damaged';
    case KeypadFaulty = 'keypad_faulty';
    case PanelDamaged = 'panel_damaged';
    case Dirty = 'dirty';
    case ItemLeftBehind = 'item_left_behind';
    case Overstayed = 'overstayed';

    public function label(): string
    {
        return match ($this) {
            self::LockJammed     => 'Lock Jammed',
            self::LockBroken     => 'Lock Broken',
            self::DoorWontOpen   => "Door Won't Open",
            self::DoorWontClose  => "Door Won't Close",
            self::DoorDamaged    => 'Door Damaged',
            self::KeypadFaulty   => 'Keypad Faulty',
            self::PanelDamaged   => 'Panel Damaged',
            self::Dirty          => 'Needs Cleaning',
            self::ItemLeftBehind => 'Item Left Behind',
            self::Overstayed     => 'Overstayed',
        };
    }

    public function defaultPriority(): string
    {
        return match ($this) {
            self::LockJammed, self::LockBroken => 'critical',
            self::DoorWontClose, self::DoorDamaged, self::KeypadFaulty => 'high',
            self::DoorWontOpen, self::PanelDamaged, self::ItemLeftBehind, self::Overstayed => 'medium',
            self::Dirty => 'low',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
