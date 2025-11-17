<?php

namespace App\Services\API;

use App\Repositories\API\ApiOrderRepository;
use App\Repositories\API\ApiProductRepository;
// use App\Models\Cart;
// use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ApiOrderService
{
    protected $orderRepo;
    protected $productRepo;

    public function __construct( ApiOrderRepository $orderRepo, ApiProductRepository $productRepo)
    {
        $this->orderRepo = $orderRepo;
        $this->productRepo = $productRepo;
    }

    public function createOrder($data)
    {
        try{
            return DB::transaction(function () use ($data) {

                $total = 0;
                foreach ($data['items'] as $item) {
                    $product = $this->productRepo->find($item['product_id']);
                    $total += $product->price * $item['quantity'];
                }

                $order = $this->orderRepo->createOrder([
                    'user_id' => $data['user_id'],
                    'total_amount' => $total,
                    'status' => 'pending',
                ]);

                foreach ($data['items'] as $item) {
                    $product = $this->productRepo->find($item['product_id']);

                    if ($product->stock < $item['quantity']) {
                        return response()->json([
                            'message' => 'Khong du hang: ' . $product->name,
                        ], 400);
                    }

                    $this->orderRepo->createOrderItems([
                        'order_id' => $order->id,
                        'product_id' => $item['product_id'],
                        'quantity'=> $item['quantity'],
                        'price' => $product->price
                    ]);

                    $this->productRepo->decreaseStock($product->id, $item['quantity']);
                    $this->productRepo->increaseSold($product->id, $item['quantity']);
                }

                return response()->json([
                    'message'=> 'Tao order thanh cong',
                    'order' => $order->load('items.product'),
                ], 201);
            });
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Loi tao order',
                'error'=> $e->getMessage()
            ], 500);
        }
    }
}
