<?php

namespace App\Enums;

enum ShippingStatus: string
{
    case PENDING = 'pending';
    case SHIPPING = 'shipping';
    case DELIVERED = 'delivered';

    public function label(): string
    {
        return match ($this) {
            self::PENDING   => 'Chưa gửi',
            self::SHIPPING  => 'Đang giao',
            self::DELIVERED => 'Đã giao',
        };
    }

    public function badgeColor(): string
    {
        return match ($this) {
            self::PENDING   => 'warning',
            self::SHIPPING  => 'info',
            self::DELIVERED => 'success',
        };
    }
}
