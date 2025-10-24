<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use App\Models\Order;

class AccountController extends Controller 
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
        ->with(['items.product.images', 'paymentTransactions.paymentMethod', 'coupon'])
        ->orderByDesc('created_at')
        ->get();

        $user = auth()->user()->load('profile');
        $user = auth()->user();
        $profile = $user->profile ?? new UserProfile(['user_id' => $user->id]);

        return view('client.pages.account.index', compact('user', 'orders', 'profile'));
    }
}
?>