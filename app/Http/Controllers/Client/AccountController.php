<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class AccountController extends Controller 
{
    public function index()
    {
        $orders = \App\Models\Order::where('user_id', auth()->id())
        ->with(['items.product.images', 'paymentTransactions.paymentMethod', 'coupon'])
        ->orderByDesc('created_at')
        ->get();

        $user = auth()->user()->load('profile');
        return view('client.pages.account.index', compact('user', 'orders'));
    }
}
?>