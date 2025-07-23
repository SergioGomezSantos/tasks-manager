<?php

namespace App\Enums;

enum StatusType: string
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    public function textColor(): string
    {
        return match ($this) {
            self::PENDING => 'text-yellow-500',
            self::IN_PROGRESS => 'text-blue-500',
            self::COMPLETED => 'text-green-500',
            self::CANCELLED => 'text-red-500',
        };
    }

    public function borderColor(): string
    {
        return match ($this) {
            self::PENDING => 'border-yellow-500',
            self::IN_PROGRESS => 'border-blue-500',
            self::COMPLETED => 'border-green-500',
            self::CANCELLED => 'border-red-500',
        };
    }

    public function backgroundColor(): string
    {
        return match ($this) {
            self::PENDING => 'bg-yellow-200',
            self::IN_PROGRESS => 'bg-blue-200',
            self::COMPLETED => 'bg-green-200',
            self::CANCELLED => 'bg-red-200',
        };
    }
}