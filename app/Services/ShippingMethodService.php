<?php

namespace App\Services;

use App\Repositories\ShippingMethodRepository;

class ShippingMethodService
{
    protected ShippingMethodRepository $repo;

    public function __construct(ShippingMethodRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function find($id)
    {
        return $this->repo->find($id);
    }

    public function create(array $data)
    {
        return $this->repo->create($data);
    }

    public function update($id, array $data)
    {
        $method = $this->repo->find($id);
        return $this->repo->update($method, $data);
    }

    public function delete($id)
    {
        $method = $this->repo->find($id);
        return $this->repo->delete($method);
    }

    public function toggleStatus($id)
    {
        return $this->repo->toggleStatus($id);
    }
}
