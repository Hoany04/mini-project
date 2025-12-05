<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Client\ClientCartService;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Requests\CartUpdateAjaxRequest;
use Illuminate\Http\Request;

class ClientCartController extends Controller
{
    protected ClientCartService $cartService;
    public function __construct(ClientCartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cart = $this->cartService->getCart(auth()->id());
        $items = $cart->items;

        return view('client.pages.cart.index', compact('cart', 'items'));
    }

    // Thêm sản phẩmariant-id-input
    public function store(StoreCartRequest $request)
    {
        $data = $request->validated();

        // Xử lý text hiển thị cho biến thể (VD: "Màu: Đỏ, Size: M")
        $variantText = '';
        if (!empty($request->variants) && is_array($request->variants)) {
            $variantPairs = [];
            foreach ($request->variants as $name => $value) {
                $variantPairs[] = ucfirst($name) . ': ' . $value;
            }
            $variantText = implode(', ', $variantPairs);
        }

        $data['variant_text'] = $variantText;

        try {
            // Gọi service xử lý thêm vào giỏ hàng (có kiểm tra tồn kho và biến thể)
            $this->cartService->addToCart(auth()->id(), $data);

            return redirect()
                ->route('client.pages.cart.index')
                ->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
        } catch (\Exception $e) {
            // Bắt lỗi và trả lại người dùng
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    // Cập nhật số lượng
    public function update(UpdateCartRequest $request, $itemId)
    {
        $data = $request->validated();

        try {
            $this->cartService->updateQuantity($itemId, $data['quantity']);
            return redirect()->route('client.pages.cart.index')->with('success', 'Cập nhật số lượng thành công!');
        } catch (\Exception $e) {
            return redirect()->route('client.pages.cart.index')->with('error', $e->getMessage());
        }
    }

    public function updateAjax(CartUpdateAjaxRequest  $request)
    {
        // Cập nhật số lượng sản phẩm trong DB
        $this->cartService->updateQuantity($request->item_id, $request->quantity);

        // Lấy lại giỏ hàng mới
        $cart = $this->cartService->getCart(auth()->id());
        $cartTotal = $cart->items->sum(fn($i) => $i->price * $i->quantity);

        // Nếu có mã giảm giá thì tính lại giảm
        $discount = 0;
        if (session('coupon')) {
            $coupon = session('coupon');

            if ($coupon['discount_type'] === 'percent') {
                // Giảm động
                $discount = $cartTotal * ($coupon['discount_value'] / 100);
            } else {
                // Giảm cố định
                $discount = $coupon['discount_amount'] ?? $coupon['discount_value'];
            }
        }

        $finalTotal = $cartTotal - $discount;

        // Trả dữ liệu JSON cho JS
        return response()->json([
            'success' => true,
            'cart_total' => number_format($cartTotal, 0, ',', '.'),
            'discount' => number_format($discount, 0, ',', '.'),
            'final_total' => number_format($finalTotal, 0, ',', '.'),
        ]);
    }

    // Xóa sản phẩm
    public function destroy($itemId)
    {
        $this->cartService->deleteItem($itemId);
        return back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
    }
}
