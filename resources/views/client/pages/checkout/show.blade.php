@extends('layouts.ClientLayout')

@section('content')
<div class="container py-5">
    <h2>Chi tiết đơn hàng #{{ $order->id }}</h2>
    <p>Ngày đặt: {{ $order->created_at->format('d/m/Y H:i') }}</p>
    <p>Trạng thái: 
        <strong class="text-capitalize">{{ $order->status }}</strong>
    </p>

    <div class="table-responsive shadow-sm mb-4">
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
                        <td>{{ number_format($item->price, 0, ',', '.') }}₫</td>
                        <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }}₫</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-secondary text-white">Tổng kết</div>
        <div class="card-body">
            <p><strong>Tổng tiền hàng:</strong>
                {{ number_format($order->items->sum(fn($i) => $i->price * $i->quantity), 0, ',', '.') }}₫
            </p>
            @if($order->coupon)
                <p><strong>Giảm giá ({{ $order->coupon->code }}):</strong> -{{ $order->coupon->discount_value }}%</p>
            @endif
            <p><strong>Tổng thanh toán:</strong> {{ number_format($order->total_amount, 0, ',', '.') }}₫</p>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-dark text-white">Thông tin thanh toán</div>
        <div class="card-body">
            @php $payment = $order->paymentTransactions->first(); @endphp
            @if($payment)
                <p><strong>Phương thức:</strong> {{ $payment->paymentMethod->name }}</p>
                <p><strong>Mã giao dịch:</strong> {{ $payment->transaction_code }}</p>
                <p><strong>Trạng thái:</strong><td>{{ $payment->paymentMethod->status ?? 'Chưa thanh toán' }}</td>
                    <td>
                        @if($order->status === 'pending')
                            <span class="badge bg-warning text-dark">Chờ xử lý</span>
                        @elseif($order->status === 'paid')
                            <span class="badge bg-success">Đã thanh toán</span>
                        @elseif($order->status === 'shipped')
                            <span class="badge bg-info text-dark">Đang giao</span>
                        @elseif($order->status === 'completed')
                            <span class="badge bg-primary">Hoàn tất</span>
                        @else
                            <span class="badge bg-danger">Đã hủy</span>
                        @endif
                    </td></p>
                <p><strong>Số tiền thanh toán:</strong> {{ number_format($payment->amount, 0, ',', '.') }}₫</p>
            @else
                <p>Chưa có thông tin thanh toán.</p>
            @endif
        </div>
    </div>

    <a href="{{ route('client.pages.checkout.index') }}" class="btn btn-outline-primary">← Quay lại danh sách đơn hàng</a>
</div>
@endsection
