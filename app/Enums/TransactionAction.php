<?php

namespace App\Enums;

enum TransactionAction: string
{
    case BUY = 'buy';
    case SELL = 'sell';

    /**
     * @return TransactionAction[]
     */
    public static function getAllActions(): array
    {
        return [
            self::BUY,
            self::SELL,
        ];
    }

    public static function getAllActionAsString(): string
    {
        return implode(',', array_map(fn($action) => $action->value, self::getAllActions()));
    }

}
