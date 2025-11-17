@extends('layouts.AdminLayout')

@section('content')
<div class="container mt-4">
    <h3 class="p-4">Chi tiết giỏ hàng #{{ $cart->id }}</h3>

    <div class="mb-3">
        <strong>Người dùng:</strong> {{ $cart->user->username ?? 'Không xác định' }} <br>
        <strong>Email:</strong> {{ $cart->user->email ?? 'N/A' }}
    </div>

    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Sản phẩm</th>
                <th>Biến thể</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Tổng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart->items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->product->name ?? 'Sản phẩm đã xóa' }}</td>
                    <td>{{ $item->variant_text ?? '-' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price) }}₫</td>
                    <td>{{ number_format($item->price * $item->quantity) }}₫</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h5 class="text-end mt-3">Tổng cộng:
        <span class="text-danger fw-bold">
            {{ number_format($cart->items->sum(fn($i) => $i->price * $i->quantity)) }}₫
        </span>
    </h5>

    <a href="{{ route('admin.carts.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
</div>
@endsection
