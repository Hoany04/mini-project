<?php
namespace App\Repositories;

use App\Models\ShippingMethod;

class ShippingMethodRepository 
{
    public function getAll()
    {
        return ShippingMethod::orderByDesc('created_at')->paginate(10);
    }

    public function find($id)
    {
        return ShippingMethod::findOrFail($id);
    }

    public function create(array $data)
    {
        return ShippingMethod::create($data);
    }

    public function update(ShippingMethod $methods, array $data)
    {
        $methods->update($data);
        return $methods;
    }

    public function delete(ShippingMethod $methods)
    {
        return $methods->delete();
    }

    public function toggleStatus($id)
    {
        $methods = $this->find($id);
        $methods->status = $methods->status === 'active' ? 'inactive' : 'active';
        $methods->save();
        return $methods;
    }

    public function allActive()
    {
        return ShippingMethod::where('status', 'active')->get();
    }
}
?>