<?php

namespace App\Enums;

enum RoleStatus: string
{
    case Admin = 'Admin';
    case Customer = 'Customer';

    public function label(): string
    {
        return match ($this) {
            self::Admin => 'Quản trị viên',
            self::Customer => 'Khách hàng',
        };
    }

    public static function options(): array
    {
        return [
            self::Admin->value => 'Quản trị viên',
            self::Customer->value => 'Khách hàng',
        ];
    }
}
