<?php

namespace App\Enums;

enum UserStatus: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => 'Đang hoạt động',
            self::INACTIVE => 'Đã khóa',
        };
    }

    public static function options(): array
    {
        return [
            self::ACTIVE->value => 'Đang hoạt động',
            self::INACTIVE->value => 'Đã khóa',
        ];
    }
}
