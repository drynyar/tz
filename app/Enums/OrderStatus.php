<?php

namespace App\Enums;

enum OrderStatus: string
{
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';

    /**
     * @return string
     */
    public function label(): string
    {
        return match ($this) {
            self::IN_PROGRESS => 'Новый',
            self::COMPLETED => 'Выполнен',
        };
    }
}
