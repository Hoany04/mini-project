<?php
namespace App\Services\Client;

use App\Repositories\OrderRepository;
use App\Repositories\OrderItemRepository;
use App\Repositories\CartRepository;
use App\Repositories\PaymentTransactionRepository;
use Illuminate\Support\Facades\DB;

class ClientOrderService
{
    protected $orderRepo;
    protected $orderItemRepo;
    protected $cartRepo;
    protected $paymentTransactionRepo;

    public function __construct(
        OrderRepository $orderRepo,
        OrderItemRepository $orderItemRepo,
        CartRepository $cartRepo,
        PaymentTransactionRepository $paymentTransactionRepo
    ) {
        $this->orderRepo = $orderRepo;
        $this->orderItemRepo = $orderItemRepo;
        $this->cartRepo = $cartRepo;
        $this->paymentTransactionRepo = $paymentTransactionRepo;
    }

    public function findWithRelations($id)
    {
        return $this->orderRepo->findWithRelations($id);
    }

    public function create($userId, $data)
    {
        return DB::transaction(function () use ($userId, $data) {
            // 1. Lấy giỏ hàng hiện tại
            $cart = $this->cartRepo->getUserCart($userId);
            if (!$cart || $cart->items->isEmpty()) {
                throw new \Exception('Giỏ hàng trống');
            }

            // 2. Tạo đơn hàng
            $order = $this->orderRepo->create([
                'user_id' => $userId,
                'coupon_id' => $data['coupon_id'] ?? null,
                'total_amount' => $cart->total_price,
                'status' => 'pending',
            ]);

            // 3. Tạo chi tiết đơn hàng
            foreach ($cart->items as $item) {
                $this->orderItemRepo->create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'variant_id' => $item->variant_id ?? null,
                    'variant_text' => $item->variant_text,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);
            }

            // 4. Tạo bản ghi thanh toán
            $this->paymentTransactionRepo->create([
                'order_id' => $order->id,
                'payment_method_id' => $data['payment_method_id'], // map theo bảng payment_methods
                'amount' => $cart->total_price,
                'transaction_code' => strtoupper(uniqid('PAY_')),
                'status' => 'pending',
            ]);

            // 5. Xóa giỏ hàng
            $this->cartRepo->clearCart($cart->id);

            return $order;
        });
    }
}
?>