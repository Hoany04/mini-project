@extends('layouts.ClientLayout')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">🧾 Lịch sử đơn hàng</h2>

    @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    
    @if($orders->isEmpty())
        <div class="alert alert-info text-center">
            Bạn chưa có đơn hàng nào.
        </div>
    @else
        <div class="table-responsive shadow-sm">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Thanh toán</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        @php
                            $payment = $order->paymentTransactions->first();
                        @endphp
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ number_format($order->total_amount, 0, ',', '.') }}₫</td>
                            <td>{{ $payment->paymentMethod->name ?? 'Chưa thanh toán' }}</td>
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
                            </td>
                            <td>
                                <a href="{{ route('client.pages.checkout.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                    Xem chi tiết
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
