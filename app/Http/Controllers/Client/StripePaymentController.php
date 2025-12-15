<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\PaymentTransaction;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;

class StripePaymentController extends Controller
{
    public function create($orderId)
    {
        $order = Order::with('user')->findOrFail($orderId);
        return view('client.pages.payment.stripe', compact('order'));
    }

    public function store(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
        $user = auth()->user();

        Stripe::setApiKey(config('services.stripe.secret'));

        // Tạo customer stripe
        $customer = Customer::create([
            'email' => $user->email,
            'source' => $request->stripeToken
        ]);

        // Thanh toán
        $charge = Charge::create([
            'customer' => $customer->id,
            'amount' => (int)($order->total_amount * 100),
            'currency' => 'vnd',
            'description' => 'Pay for your order #' . $order->id,
            'shipping' => [
                'address' => [
                    'postal_code' => '70000',
                ],
                'name' => $user->name ?? 'Client',
            ],
        ]);

        // Lưu giao dịch
        PaymentTransaction::create([
            'order_id' => $order->id,
            'payment_method_id' => 2, // Stripe
            'amount' => $order->total_amount,
            'transaction_code' => $charge->id,
            'status' => 'paid',
        ]);

        $order->update(['status' => 'paid']);

        return redirect()->route('client.pages.checkout.success', $order->id)
                        ->with('success', 'Stripe payment successful!');
    }
}
