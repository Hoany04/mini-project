<?php

namespace App\Services\API;

use App\Repositories\API\ApiOrderRepository;
use App\Models\Cart;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ApiOrderService
{
    protected $orderRepo;

    public function __construct(ApiOrderRepository $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    public function createOrder($userId)
    {
        return DB::transaction(function () use ($userId) {

            $cart = Cart::with('items')->where('user_id', $userId)->first();

            if (!$cart || $cart->items->count() == 0) {
                throw ValidationException::withMessages([
                    'cart' => 'Giỏ hàng đang trống'
                ]);
            }

            // Tính tổng tiền
            $subtotal = $cart->items->sum(fn($item) => $item->price * $item->quantity);
            $discount = $cart->discount ?? 0;
            $total = $subtotal - $discount;

            // Tạo đơn hàng
            $order = $this->orderRepo->createOrder([
                'user_id' => $userId,
                'coupon_id' => $cart->coupon_id,
                'subtotal' => $subtotal,
                'discount' => $discount,
                'total_amount' => $total,
                'status' => 'pending',
            ]);

            // Lưu items từ cart sang order_items
            $this->orderRepo->createOrderItems($order->id, $cart->items->toArray());

            // Trừ tồn kho
            foreach ($cart->items as $item) {
                if ($item->variant_id) {
                    $variant = ProductVariant::find($item->variant_id);

                    if ($variant) {
                        $variant->stock -= $item->quantity;

                        if ($variant->stock < 0) {
                            throw ValidationException::withMessages([
                                'stock' => 'Sản phẩm "' . $item->product->name . '" không đủ tồn kho.'
                            ]);
                        }

                        $variant->save();
                    }
                }
            }

            // Xoá giỏ hàng
            $cart->items()->delete();
            $cart->delete();

            return $order->load([
                'user:id,username,email',
                'order_items:id,order_id,product_id,variant_id,quantity,price,variant_text',
                'order_items.product:id,name,price',
                'order_items.variant:id,sku,stock',
                'paymentTransactions:id,order_id,amount,status,transaction_code',
                'shipping:id,order_id,shipping_method_id,status'
            ]);
        });
    }
}
