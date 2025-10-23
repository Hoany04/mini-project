<?php
namespace App\Repositories;

use App\Models\ShippingMethod;

class ShippingMethodRepository 
{
    public function allActive()
    {
        return ShippingMethod::where('status', 'active')->get();
    }

    public function find($id)
    {
        return ShippingMethod::find($id);
    }
}
?>