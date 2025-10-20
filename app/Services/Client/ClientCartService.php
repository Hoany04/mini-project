<?php

namespace App\Services\Client;

use App\Repositories\CartRepository;

class ClientCartService
{
    /**
     * Create a new class instance.
     */

     protected $cartRepo;
    public function __construct(CartRepository $cartRepo)
    {
        $this->cartRepo = $cartRepo;
    }

    public function getCart($userId)
    {
        return $this->cartRepo->getUserCart($userId);
    }

    public function addToCart($userId, array $data)
    {
        $cart = $this->cartRepo->getUserCart($userId);
        $item = $this->cartRepo->addItem($cart, $data);

        $this->updateTotal($cart);
        return $item;
    }

    public function updateQuantity($itemId, $quantity)
    {
        $item = $this->cartRepo->updateItemQuantity($itemId, $quantity);
        $this->updateTotal($item->cart);
        return $item;
    }

    public function deleteItem($itemId)
    {
        $item = $this->cartRepo->deleteItem($itemId);
    }

    protected function updateTotal($cart)
    {
        $total = $cart->items->sum(fn($i) => $i->price * $i->quantity);
        $cart->update(['total_price' => $total]);
    }
}
