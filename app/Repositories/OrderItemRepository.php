<?php
namespace App\Repositories;

use App\Models\OrderItem;

class OrderItemRepository
{
    public function create(array $data)
    {
        return OrderItem::create($data);
    }

    public function bulkCreate(array $items)
    {
        return OrderItem::insert($item);
    }
}
?>