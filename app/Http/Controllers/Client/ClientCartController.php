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
            'price' => 'required|numeric|min:0'
        ]);
    
        $variantText = '';
    
        if ($request->has('variants') && is_array($request->variants)) {
            $variantPairs = [];
            foreach ($request->variants as $name => $value) {
                $variantPairs[] = ucfirst($name) . ': ' . $value;
            }
            $variantText = implode(', ', $variantPairs);
        }
    
        $cart = session()->get('cart', []);
        $productId = $data['product_id'];
    
        // Nếu sản phẩm đã có trong giỏ => tăng số lượng
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $data['quantity'];
        } else {
            $cart[$productId] = [
                'product_id' => $productId,
                'variant_id' => $data['variant_id'],
                'variant_text' => $variantText,
                'price' => $data['price'],
                'quantity' => $data['quantity'],
            ];
        }
    
        session()->put('cart', $cart);
    
        return redirect()->route('client.pages.cart.index')
                         ->with('success', 'Đã thêm vào giỏ hàng');
    }

    // Cập nhật số lượng
    public function update(Request $request, $itemId)
    {
        $this->cartService->updateQuantity($itemId, $request->quantity);
        return back()->with('success', 'Cập nhật giỏ hàng thành công');
    }

    // Xóa sản phẩm
    public function destroy($itemId)
    {
        $this->cartService->deleteItem($itemId);
        return back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
    }
}
