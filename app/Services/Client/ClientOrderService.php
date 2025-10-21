<?php
namespace App\Services\Client;

use App\Repositories\OrderRepository;
use App\Repositories\OrderItemRepository;
use App\Services\Client\ClientCartService;
use App\Services\Client\ClientCouponService;
use Illuminate\Support\Facades\DB;

class ClientOrderService
{
    protected $orderRepo;
    protected $orderItemRepo;
    protected $cartService;
    protected $couponService;

    public function __construct(
        OrderRepository $orderRepo,
        OrderItemRepository $orderItemRepo,
        ClientCartService $cartService,
        ClientCouponService $couponService
    ) {
        $this->orderRepo = $orderRepo;
        $this->orderItemRepo = $orderItemRepo;
        $this->cartService = $cartService;
        $this->couponService = $couponService;
    }

    public function placeOrder($user, $couponCode = null)
    {
        $cart = $this->cartService->getCart($user->id);

        if (!$cart || $cart->items->isEmpty()) {
            throw new \Exception('Gio hang cua ban dang trong.');
        }

        DB::beginTransaction();

        try {
            $coupon = null;
            $discountAmount = 0;

            if ($couponCode) {
                $coupon = $this->couponService->validateCoupon($couponCode, $cart->total_price);
                $discountAmount = $coupon ? $this->couponService->calculateDiscount($coupon, $cart->total_price) : 0;
            }

            $totalAmount = $cart->total_price - $discountAmount;

            $order = $this->orderRepo->create([
                'user_id' => $user->id,
                'coupon_id' => $coupon?->id,
                'total_amount' => $totalAmount,
                'status' => 'pending',
            ]);

            $orderItems = [];
            foreach ($cart->items as $item) {
                $orderItems[] = [
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'variant_id' => $item->variant_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            $this->orderItemRepo->bulkCreate($orderItems);

            // Dọn giỏ hàng
            $cart->items()->delete();
            $cart->update(['total_price' => 0]);

            DB::commit();

            return $order;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw new \Exception('Lỗi khi tạo đơn hàng: ' . $e->getMessage());
        }
    }
}
?>