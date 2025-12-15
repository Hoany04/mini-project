<?php

namespace App\Services;

use App\Enums\PaymentMethodStatus;
use App\Repositories\PaymentMethodRepository;

class PaymentMethodService
{
    protected PaymentMethodRepository $repo;

    public function __construct(PaymentMethodRepository $repo)
    {
        $this->repo = $repo;
    }

    public function list()
    {
        return $this->repo->getAll();
    }

    public function find($id)
    {
        return $this->repo->find($id);
    }

    public function create($data)
    {
        if (!empty($data['status'])) {
            try {
                $data['status'] = PaymentMethodStatus::from($data['status'])->value;
            } catch (\ValueError $e) {
                throw new \Exception("Invalid payment method status");
            }
        }

        return $this->repo->create($data);
    }

    public function update($id, $data)
    {
        if (!empty($data["status"])) {
            try {
                $data['status'] = PaymentMethodStatus::from($data['status'])->value;
            } catch (\ValueError $e) {
                throw new \Exception("Invalid payment method status");
            }
        }

        return $this->repo->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }
}
