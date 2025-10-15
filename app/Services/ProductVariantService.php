<?php

namespace App\Services;

use App\Repositories\ProductVariantRepository;
class ProductVariantService
{
    /**
     * Create a new class instance.
     */

     protected $repo;
    public function __construct(ProductVariantRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getByProduct($productId)
    {
        return $this->repo->getAllByProduct($productId);
    }

    public function create(array $data)
    {
        return $this->repo->create($data);
    }

    public function update($id, array $data)
    {
        $variant = $this->repo->find($id);
        return $this->repo->update($variant, $data);
    }

    public function delete($id)
    {
        $variant = $this->repo->find($id);
        return $this->repo->delete($variant);
    }
}
