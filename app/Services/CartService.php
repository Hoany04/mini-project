<?php

namespace App\Services;

use App\Repositories\CartRepository;

class CartService
{
    /**
     * Create a new class instance.
     */

     protected CartRepository $cartRepo;
    public function __construct(CartRepository $cartRepo)
    {
        $this->cartRepo = $cartRepo;
    }

    public function getAllCarts()
    {
        return $this->cartRepo->getAllCarts();
    }

    public function getCartById($id)
    {
        return $this->cartRepo->findById($id);
    }

    public function deleteCart($id)
    {
        return $this->cartRepo->deleteCart($id);
    }
}
