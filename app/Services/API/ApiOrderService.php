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
    protected $productRepo;

    public function __construct(ApiOrderRepository $orderRepo, ApiProductRepository $productRepo)
    {
        $this->orderRepo = $orderRepo;
        $this->productRepo = $productRepo;
    }

    public function createOrder($data)
    {
        try{
            $items = collect($data['items']);
            $productIds = $items->pluck('product_id')->toArray();

            $products = $this->productRepo->getProductsByIds($productIds);

            foreach ($items as $item) {
                $productId = $item['product_id'];
                $quantity = $item['quantity'];

                $product = $products->get($productId);

                if (!$product) {
                    throw ValidationException::withMessages([
                        'product_id' => "Sản phẩm ID {$productId} không tồn tại",
                    ]);
                }

                if ($product->stock < $quantity) {
                    throw ValidationException::withMessages([
                        'stock' => "Không đủ hàng: {$product->name}",
                    ]);
                }
            }

            $total = $items->sum(fn($item) => $products->get($item['product_id'])->price * $item['quantity']);

            $order = DB::transaction(function () use ($data, $items, $products, $total) {
                $order = $this->orderRepo->createOrder([
                    'user_id' => $data['user_id'],
                    'total_amount' => $total,
                    'status' => OrderStatus::PENDING->value,
                ]);

                foreach ($items as $item) {
                    $productId = $item['product_id'];
                    $product = $products->get($productId);

                    $this->orderRepo->createOrderItems([
                        'order_id' => $order->id,
                        'product_id' => $item['product_id'],
                        'quantity'=> $item['quantity'],
                        'price' => $product->price
                    ]);

                    $this->productRepo->decreaseStock($product->id, $item['quantity']);
                    $this->productRepo->increaseSold($product->id, $item['quantity']);
                }

                return $order;
            });

            return response()->json([
                'message'=> 'Tao order thanh cong',
                'order' => $order->load('items.product'),
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Du lieu khong hop le',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Loi tao order',
                'error'=> $e->getMessage(),
            ], 500);
        }
    }
}
