<?php

namespace App\Enums;

enum PriorityType: string
{
    case LOW = 'low';
    case NORMAL = 'normal';
    case HIGH = 'high';

    public function textColor(): string
    {
        return match ($this) {
            self::NORMAL => 'text-yellow-500',
            self::LOW => 'text-green-500',
            self::HIGH => 'text-red-500',
        };
    }

    public function borderColor(): string
    {
        return match ($this) {
            self::NORMAL => 'border-yellow-500',
            self::LOW => 'border-green-500',
            self::HIGH => 'border-red-500',
        };
    }
}