<?php

namespace App\Services\API;

use App\Repositories\API\ApiOrderRepository;
use App\Repositories\API\ApiProductRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Enums\OrderStatus;

class ApiOrderService
{
    protected ApiOrderRepository $orderRepo;
    protected ApiProductRepository $productRepo;

    public function __construct(ApiOrderRepository $orderRepo, ApiProductRepository $productRepo)
    {
        $this->orderRepo = $orderRepo;
        $this->productRepo = $productRepo;
    }

    public function createOrder($data)
    {
        try {
            $items = collect($data['items']);
            $productIds = $items->pluck('product_id')->toArray();

            // Lấy product 1 lần — không query trong foreach
            $products = $this->productRepo->getProductsByIds($productIds);

            // Build dạng map: id => product object
            $productMap = $products->keyBy('id');

            // Validate tồn kho — không query thêm
            foreach ($items as $item) {
                $productId = $item['product_id'];

                if (!isset($productMap[$productId])) {
                    throw ValidationException::withMessages([
                        'product_id' => "Product ID {$productId} does not exist",
                    ]);
                }

                if ($productMap[$productId]->stock < $item['quantity']) {
                    throw ValidationException::withMessages([
                        'stock' => "Insufficient stock: {$productMap[$productId]->name}",
                    ]);
                }
            }

            // Tính tổng giá
            $total = $items->sum(fn ($item) =>
                $productMap[$item['product_id']]->price * $item['quantity']
            );

            $order = DB::transaction(function () use ($data, $items, $productMap, $total) {

                $order = $this->orderRepo->createOrder([
                    'user_id' => $data['user_id'],
                    'total_amount' => $total,
                    'status' => OrderStatus::PENDING->value,
                ]);

                // Build order items array để insert 1 lần
                $orderItems = [];

                // Build update stock & sold
                $updatesStock = [];
                $updatesSold = [];

                foreach ($items as $item) {
                    $product = $productMap[$item['product_id']];

                    $orderItems[] = [
                        'order_id'   => $order->id,
                        'product_id' => $product->id,
                        'quantity'   => $item['quantity'],
                        'price'      => $product->price,
                    ];

                    // Upsert giảm tồn kho
                    $updatesStock[] = [
                        'id'    => $product->id,
                        'stock' => $product->stock - $item['quantity']
                    ];

                    // Upsert tăng sold
                    $updatesSold[] = [
                        'id'   => $product->id,
                        'sold' => $product->sold + $item['quantity']
                    ];
                }

                // Insert toàn bộ order_items — không dùng create trong foreach
                $this->orderRepo->insertOrderItems($orderItems);

                // Update tồn kho & sold bằng upsert
                $this->productRepo->updateStockBatch($updatesStock);
                $this->productRepo->updateSoldBatch($updatesSold);

                return $order;
            });

            return response()->json([
                'message' => 'Order successfully created.',
                'order' => $order->load('items.product'),
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Invalid data',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Order creation error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
