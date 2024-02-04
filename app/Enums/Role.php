<?php

namespace App\Enums;

enum Role: string
{
    case ADMIN = 'Admin';
    case OPERATOR = 'Operator';
    case USER = 'User';

    /**
     * @return Role[]
     */
    public static function getAllRoles(): array
    {
        return [
            self::ADMIN,
            self::OPERATOR,
            self::USER,
        ];
    }
}
