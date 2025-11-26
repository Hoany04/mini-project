<?php
namespace App\Services\Client;

use App\Repositories\ShippingMethodRepository;

class ClientShippingService
{
    protected ShippingMethodRepository $shippingRepo;

    public function __construct(ShippingMethodRepository $shippingRepo)
    {
        $this->shippingRepo = $shippingRepo;
    }

    public function getAvailableMethods()
    {
        return $this->shippingRepo->allActive();
    }

    public function getFee($id)
    {
        $method = $this->shippingRepo->find($id);
        return $method ? $method->fee : 0;
    }
}
?>
