@extends('layouts.AdminLayout')

@section('content')
<div class="container mt-4 card">
    <h3>Chi tiết đơn hàng #{{ $order->id }}</h3>

    <div class="mb-3">
        <strong>Khách hàng:</strong> {{ $order->user->username ?? 'N/A' }} <br>
        <strong>Email:</strong> {{ $order->user->email ?? 'N/A' }} <br>
        <strong>Trạng thái:</strong> <span class="badge bg-info text-dark">{{ ucfirst($order->status) }}</span>
    </div>

    <h5>Sản phẩm trong đơn hàng</h5>
    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Tổng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->product->name ?? 'Đã xóa' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price) }}₫</td>
                    <td>{{ number_format($item->price * $item->quantity) }}₫</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h5 class="text-end mt-3">
        Tổng cộng: <span class="text-danger fw-bold">{{ number_format($order->total_amount) }}₫</span>
    </h5>

    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
</div>
@endsection
