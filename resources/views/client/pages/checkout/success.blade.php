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
        <h2 class="text-success">🎉 Đặt hàng thành công!</h2>
        <p>Cảm ơn bạn đã mua hàng cùng chúng tôi.</p>
        <h5>Mã đơn hàng: <strong>#{{ $order->id }}</strong></h5>
        <p>Ngày đặt: {{ $order->created_at->format('Y/m/d H:i') }}</p>
    </div>

    <!-- Thông tin người đặt -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-dark text-white">Địa chỉ giao hàng</div>
        <div class="card-body">
            <p><strong>Người nhận:</strong> {{ $order->shipping->address->full_name ?? 'N/A' }}</p>
            <p><strong>Số điện thoại:</strong> {{ $order->shipping->address->phone ?? '-' }}</p>
            <p><strong>Địa chỉ:</strong>
                {{ $order->shipping->address->address_detail ?? '' }},
                {{ $order->shipping->address->ward ?? '' }},
                {{ $order->shipping->address->district ?? '' }},
                {{ $order->shipping->address->province ?? '' }}
            </p>
            <p><strong>Ghi chú giao hàng:</strong> {{ $order->shipping->delivery_note ?? '-' }}</p>
            <p><strong>Phương thức vận chuyển:</strong> {{ $order->shipping->method->name ?? '-' }}</p>
        </div>
    </div>


    <!-- Danh sách sản phẩm -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-dark text-white">Chi tiết sản phẩm</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Biến thể</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Tổng</th>
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
                            <td>{{ $item->variant_text ?? 'Không có' }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->price, 0, ',', '.') }}₫</td>
                            <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }}₫</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-end">Tổng tiền hàng:</th>
                        <th>{{ number_format($order->items->sum(fn($i) => $i->price * $i->quantity), 0, ',', '.') }}₫</th>
                    </tr>
                    @if ($order->coupon)
                    <tr>
                        <th colspan="4" class="text-end">Giảm giá ({{ $order->coupon->code }}):</th>
                        <th>-{{ $order->coupon->discount_value }}%</th>
                    </tr>
                    @endif
                    <tr>
                        <th colspan="4" class="text-end">Phí vận chuyển</th>
                        <th>{{ number_format($order->shipping->method->fee ?? 0) }}₫</th>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-end">Tổng thanh toán:</th>
                        <th>{{ number_format($order->total_amount, 0, ',', '.') }}₫</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Thông tin thanh toán -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-secondary text-white">Phương thức thanh toán</div>
        <div class="card-body">
            @php
                $payment = $order->paymentTransactions->first();
            @endphp

            @if($payment)
                <p><strong>Phương thức:</strong> {{ $payment->paymentMethod->name }}</p>
                <p><strong>Mã giao dịch:</strong> {{ $payment->transaction_code }}</p>
                <p><strong>Trạng thái:</strong><td>{{ $payment->status ?? 'Chưa thanh toán' }}</td>
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
                                    <span class="badge bg-danger">Đã hủy</span>
                                @endif
                            </td></p>
                <p><strong>Số tiền thanh toán:</strong> {{ number_format($payment->amount, 0, ',', ',') }}₫</p>
            @else
                <p>Chưa có thông tin thanh toán.</p>
            @endif
        </div>
    </div>

    <div class="text-center">
        <a href="{{ route('client.home') }}" class="btn btn-primary">Quay lại trang chủ | </a>
        <a href="{{ route('client.pages.checkout.index') }}" class="btn btn-outline-dark">Xem lịch sử đơn hàng</a>
    </div>
</div>
@endsection
