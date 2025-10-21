<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Client\ClientCartService;
use Illuminate\Http\Request;

class ClientCartController extends Controller
{
    protected $cartService;
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
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'variant_id' => 'nullable|exists:product_variants,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $variantText = '';

        if ($request->has('variants') && is_array($request->variants)) {
            $variantPairs = [];
            foreach ($request->variants as $name => $value) {
                $variantPairs[] = ucfirst($name) . ': ' . $value;
            }
            $variantText = implode(', ', $variantPairs);
        }

        $data['variant_text'] = $variantText;

        $this->cartService->addToCart(auth()->id(), $data);

        return redirect()->route('client.pages.cart.index')
                        ->with('success', 'Đã thêm vào giỏ hàng');
    }

    // Cập nhật số lượng
    public function update(Request $request, $itemId)
    {
        $this->cartService->updateQuantity($itemId, $request->quantity);
        return back()->with('success', 'Cập nhật giỏ hàng thành công');
    }

    public function updateAjax(Request $request)
    {
        $request->validate([
            'item_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

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
