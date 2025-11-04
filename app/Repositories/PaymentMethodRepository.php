<?php

namespace App\Repositories;

use App\Models\PaymentMethod;

class PaymentMethodRepository
{
    public function getAll()
    {
        return PaymentMethod::orderByDesc('id')->paginate(10);
    }

    public function find($id)
    {
        return PaymentMethod::findOrFail($id);
    }

    public function create(array $data)
    {
        return PaymentMethod::create($data);
    }

    public function update($id, array $data)
    {
        $method = $this->find($id);
        $method->update($data);
        return $method;
    }

    public function delete($id)
    {
        return PaymentMethod::destroy($id);
    }
}
