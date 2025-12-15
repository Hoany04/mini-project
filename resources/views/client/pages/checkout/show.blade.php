@extends('layouts.ClientLayout')
<?php
use Carbon\Carbon;
?>
@section('content')
<div class="container py-5">
    <h2>Order details #{{ $order->id }}</h2>
    <p>Date of booking: {{ $order->created_at->format('Y/m/d H:i') }}</p>
    <p>Status:
        <strong class="text-capitalize">{{ $order->status }}</strong>
    </p>

    <div class="table-responsive shadow-sm mb-4">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Product</th>
                    <th>Variant</th>
                    <th>Price</th>
                    <th>Unit price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($item->product->images->first())
                                    <img src="{{ asset('storage/' . $item->product->images->first()->image_url) }}"
                                         width="60" class="me-2 rounded">
                                @endif
                                <span>{{ $item->product->name }}</span>
                            </div>
                        </td>
                        <td>{{ $item->variant_text ?? '-' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price, 0, ',', ',') }}₫</td>
                        <td>{{ number_format($item->price * $item->quantity, 0, ',', ',') }}₫</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-secondary text-white">Summary</div>
        <div class="card-body">
            <p><strong>Total amount of goods:</strong>
                {{ number_format($order->items->sum(fn($i) => $i->price * $i->quantity), 0, ',', ',') }}₫
            </p>
            @if($order->coupon)
                <p><strong>Discount ({{ $order->coupon->code }}):</strong> -{{ $order->coupon->discount_value }}%</p>
            @endif
            <p><strong>Shipping fee:</strong>{{ number_format($order->shipping->method->fee ?? 0) }}đ</p>
            <p><strong>Total payment:</strong> {{ number_format($order->total_amount, 0, ',', ',') }}₫</p>
        </div>
    </div>

    <div class="shipping-timeline mt-4">
        <h5>Delivery status</h5>

        @php
            $step = $order->getShippingTimeline();
        @endphp

        <div class="timeline-container d-flex justify-content-between">
            @php
                $steps = [
                    1 => 'Order placed',
                    2 => 'In transit',
                    3 => 'Delivery completed.'
                ];
            @endphp

            @foreach($steps as $index => $label)
                <div class="timeline-step text-center">
                    <div class="circle {{ $step >= $index ? 'active' : '' }}">
                        {{ $index }}
                    </div>
                    <div class="label {{ $step >= $index ? 'active' : '' }}">
                        {{ $label }}
                    </div>
                </div>

                @if (!$loop->last)
                    <div class="line {{ $step > $index ? 'active' : '' }}"></div>
                @endif
            @endforeach
        </div>
    </div>


    <div class="card shadow-sm mb-4">
        <div class="card-header bg-dark text-white">Payment information</div>
        <div class="card-body">
            @php $payment = $order->paymentTransactions->first(); @endphp
            @if($payment)
                <p><strong>Method:</strong> {{ $payment->paymentMethod->name }}</p>
                <p><strong>Transaction code:</strong> {{ $payment->transaction_code }}</p>
                <p><strong>Status:</strong><td>{{ $payment->status ?? 'Unpaid' }}</td>
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

    <a href="{{ route('client.pages.checkout.index') }}" class="btn btn-outline-primary">← Return to order list</a>
</div>
@endsection
