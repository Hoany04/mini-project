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
    try {
        $items = collect($data['items']);
        $productIds = $items->pluck('product_id')->toArray();

        // Lấy product 1 lần
        $products = $this->productRepo->getProductsByIds($productIds)->keyBy('id');

        // Validate tồn tại & số lượng
        foreach ($items as $item) {
            $product = $products->get($item['product_id']);

            if (!$product) {
                throw ValidationException::withMessages([
                    'product_id' => "Sản phẩm ID {$item['product_id']} không tồn tại",
                ]);
            }

            if ($product->stock < $item['quantity']) {
                throw ValidationException::withMessages([
                    'stock' => "Không đủ hàng: {$product->name}",
                ]);
            }
        }

        // Tính tổng tiền
        $total = $items->sum(fn ($item) =>
            $products[$item['product_id']]->price * $item['quantity']
        );

        $order = DB::transaction(function () use ($data, $items, $products, $total) {

            // Tạo order
            $order = $this->orderRepo->createOrder([
                'user_id' => $data['user_id'],
                'total_amount' => $total,
                'status' => OrderStatus::PENDING->value,
            ]);

            // Build mảng order_items
            $orderItems = [];
            $stockCases = "";
            $soldCases = "";
            $ids = [];

            foreach ($items as $item) {
                $product = $products[$item['product_id']];

                $orderItems[] = [
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                ];

                // Tối ưu update stock (CASE WHEN)
                $stockCases .= "WHEN {$product->id} THEN stock - {$item['quantity']} ";
                $soldCases  .= "WHEN {$product->id} THEN sold + {$item['quantity']} ";

                $ids[] = $product->id;
            }

            // Insert order item batch
            DB::table('order_items')->insert($orderItems);

            // Bulk update stock
            DB::update("
                UPDATE products
                SET stock = CASE id
                    $stockCases
                END
                WHERE id IN (" . implode(',', $ids) . ")
            ");

            // Bulk update sold
            DB::update("
                UPDATE products
                SET sold = CASE id
                    $soldCases
                END
                WHERE id IN (" . implode(',', $ids) . ")
            ");

            return $order;
        });

        return response()->json([
            'message' => 'Tạo order thành công',
            'order' => $order->load('items.product'),
        ], 201);

    } catch (ValidationException $e) {
        return response()->json([
            'message' => 'Dữ liệu không hợp lệ',
            'errors' => $e->errors(),
        ], 422);

    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Lỗi tạo order',
            'error' => $e->getMessage(),
        ], 500);
    }
}

}
