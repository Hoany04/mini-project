@extends('layouts.ClientLayout')
<?php
use Carbon\Carbon;
?>
@section('content')
<div class="container py-5">
    @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
    <div class="text-center mb-5">
        <h2 class="text-success">🎉 Order placed successfully!</h2>
        <p>Thank you for shopping with us..</p>
        <h5>Order code: <strong>#{{ $order->id }}</strong></h5>
        <p>Date of booking: {{ $order->created_at->format('Y/m/d H:i') }}</p>
    </div>

    <!-- Thông tin người đặt -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-dark text-white">Delivery address</div>
        <div class="card-body">
            <p><strong>Receiver:</strong> {{ $order->shipping->address->full_name ?? 'N/A' }}</p>
            <p><strong>Phone number:</strong> {{ $order->shipping->address->phone ?? '-' }}</p>
            <p><strong>Address:</strong>
                {{ $order->shipping->address->address_detail ?? '' }},
                {{ $order->shipping->address->ward ?? '' }},
                {{ $order->shipping->address->district ?? '' }},
                {{ $order->shipping->address->province ?? '' }}
            </p>
            <p><strong>Delivery notes:</strong> {{ $order->shipping->delivery_note ?? '-' }}</p>
            <p><strong>Shipping method:</strong> {{ $order->shipping->method->name ?? '-' }}</p>
        </div>
    </div>


    <!-- Danh sách sản phẩm -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-dark text-white">Product details</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Product</th>
                        <th>Variant</th>
                        <th>Quantity</th>
                        <th>Unit price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($item->product->images->first())
                                        <img src="{{ asset('storage/' . $item->product->images->first()->image_url) }}"
                                             alt="{{ $item->product->name }}" width="50" class="me-2">
                                    @endif
                                    <span>{{ $item->product->name }}</span>
                                </div>
                            </td>
                            <td>{{ $item->variant_text ?? 'Do not have' }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->price, 0, ',', '.') }}₫</td>
                            <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }}₫</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-end">Total amount of goods:</th>
                        <th>{{ number_format($order->items->sum(fn($i) => $i->price * $i->quantity), 0, ',', '.') }}₫</th>
                    </tr>
                    @if ($order->coupon)
                    <tr>
                        <th colspan="4" class="text-end">Discount ({{ $order->coupon->code }}):</th>
                        <th>-{{ $order->coupon->discount_value }}%</th>
                    </tr>
                    @endif
                    <tr>
                        <th colspan="4" class="text-end">Shipping fee</th>
                        <th>{{ number_format($order->shipping->method->fee ?? 0) }}₫</th>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-end">Total payment:</th>
                        <th>{{ number_format($order->total_amount, 0, ',', '.') }}₫</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Thông tin thanh toán -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-secondary text-white">Payment methods</div>
        <div class="card-body">
            @php
                $payment = $order->paymentTransactions->first();
            @endphp

            @if($payment)
                <p><strong>Method:</strong> {{ $payment->paymentMethod->name }}</p>
                <p><strong>Transaction code:</strong> {{ $payment->transaction_code }}</p>
                <p><strong>Status:</strong><td>{{ $payment->status ?? 'Chưa thanh toán' }}</td>
                            <td>
                                @if($order->status === 'pending')
                                    {{-- <span class="badge bg-warning text-dark">Chờ xử lý</span> --}}
                                @elseif($order->status === 'paid')
                                    {{-- <span class="badge bg-success">Đã thanh toán</span> --}}
                                @elseif($order->status === 'shipped')
                                    {{-- <span class="badge bg-info text-dark">Đang giao</span> --}}
                                @elseif($order->status === 'completed')
                                    {{-- <span class="badge bg-primary">Hoàn tất</span> --}}
                                @else
                                    <span class="badge bg-danger">Cancelled</span>
                                @endif
                            </td></p>
                <p><strong>Amount to be paid:</strong> {{ number_format($payment->amount, 0, ',', ',') }}₫</p>
            @else
                <p>No payment information available..</p>
            @endif
        </div>
    </div>

    <div class="text-center">
        <a href="{{ route('client.home') }}" class="btn btn-primary">Return to homepage | </a>
        <a href="{{ route('client.pages.checkout.index') }}" class="btn btn-outline-dark">View order history</a>
    </div>
</div>
@endsection
