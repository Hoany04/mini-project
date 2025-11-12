<?php
namespace App\Services\Client;

use App\Models\OrderItem;
use App\Models\OrderShipping;
use App\Models\ShippingMethod;
use App\Models\ProductVariant;
use App\Models\Product;
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
        return $this->orderRepo->findWithRelations($id, false);
    }

    public function create($userId, $data)
    {
        return DB::transaction(function () use ($userId, $data) {
            // Lấy giỏ hàng hiện tại
            $cart = $this->cartRepo->getUserCart($userId);
            if (!$cart || $cart->items->isEmpty()) {
                return redirect()
                    ->route('client.pages.cart.index')
                    ->with('error', 'Giỏ hàng trống, vui lòng thêm sản phẩm trước khi thanh toán!');
            }

            // Tính tổng giá trị giỏ hàng
            $cartTotal = $cart->items->sum(fn($item) => $item->price * $item->quantity);

            // Lấy phương thức vận chuyển và phí ship
            $shippingMethod = ShippingMethod::find($data['shipping_method_id'] ?? null);
            $shippingFee = $shippingMethod ? $shippingMethod->fee : 0;

            // Giảm giá (nếu có)
            $discount = $data['discount'] ?? 0;

            // Tính tổng tiền cuối cùng (có cộng phí vận chuyển)
            $totalAmount = $cartTotal - $discount + $shippingFee;

            // Tạo đơn hàng
            $order = $this->orderRepo->create([
                'user_id' => $userId,
                'coupon_id' => $data['coupon_id'] ?? null,
                'total_amount' => $totalAmount,
                'status' => 'pending',
            ]);

            // Tạo chi tiết đơn hàng
            $orderItems = [];

            foreach ($cart->items as $item) {
                $orderItems[] = [
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'variant_id' => $item->variant_id ?? null,
                    'variant_text' => $item->variant_text,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ];

                $product = Product::find($item['product_id']);
                if ($product->stock >= $item['quantity']) {
                    $product->decrement('stock', $item['quantity']);
                    $product->increment('sold', $item['quantity']);
                } else {
                    throw new \Exception("Sản phẩm {$product->name} không đủ hàng");
                }

                if ($item->variant_id) {
                    // dd($item->variant_id);
                    $variant = ProductVariant::find($item->variant_id);

                    if ($variant && $variant->stock >= $item->quantity) {
                        $variant->decrement('stock', $item->quantity);
                    } else {
                        throw new \Exception("Biến thể {$variant->variant_value} không đủ hàng trong kho!");
                    }
                } else {
                    // nếu spham ko co bien the
                    $product = Product::find($item->product_id);
                    if ($product && $product->stock >= $item->quantity) {
                        $product->decrement('stock', $item->quantity);
                    } else {
                        throw new \Exception("Sản phẩm {$product->name} không đủ hàng trong kho!");
                    }
                }
            }

            OrderItem::insert($orderItems);

            // Tạo thông tin vận chuyển (nếu có)
            if (!empty($data['shipping_address_id']) && !empty($data['shipping_method_id'])) {
                OrderShipping::create([
                    'order_id' => $order->id,
                    'shipping_method_id' => $data['shipping_method_id'],
                    'shipping_address_id' => $data['shipping_address_id'],
                    'delivery_note' => $data['delivery_note'] ?? null,
                    'status' => 'pending',
                ]);
            }

            // Tạo bản ghi thanh toán
            $this->paymentTransactionRepo->create([
                'order_id' => $order->id,
                'payment_method_id' => $data['payment_method_id'], // map theo bảng payment_methods
                'amount' => $totalAmount,
                'transaction_code' => strtoupper(uniqid('PAY_')),
                'status' => 'pending',
            ]);

            // Xóa giỏ hàng
            $this->cartRepo->clearCart($cart->id);

            return $order;
        });
    }
}
?>
