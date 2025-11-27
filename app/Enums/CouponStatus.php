<?php

namespace App\Enums;

enum CouponStatus: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case EXPPIRED = 'expired';

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => 'Kích hoạt',
            self::INACTIVE => 'Vô hiệu',
            self::EXPPIRED => 'hết hạn',
        };
    }

    public function badgeColor(): string
    {
        return match ($this) {
            self::ACTIVE => 'success',
            self::INACTIVE => 'secondary',
            self::EXPPIRED => 'danger',
        };
    }
}
