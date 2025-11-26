<?php
namespace App\Services;

use App\Repositories\PaymentTransactionRepository;

class PaymentTransactionService
{
    protected PaymentTransactionRepository $repo;

    public function __construct(PaymentTransactionRepository $repo)
    {
        $this->repo = $repo;
    }

    public function list($filters = [])
    {
        return $this->repo->getAll($filters);
    }

    public function find($id)
    {
        return $this->repo->find($id);
    }
}
?>
