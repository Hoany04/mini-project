<?php

namespace App\Enums;

enum PaymentMethodStatus: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => 'Kich hoạt',
            self::INACTIVE => 'Tạm ngừng',
        };
    }

    public function badgeColor(): string
    {
        return match ($this) {
            self::ACTIVE => 'success',
            self::INACTIVE => 'secondary',
        };
    }
}
