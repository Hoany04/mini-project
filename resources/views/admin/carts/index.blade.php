@extends('layouts.AdminLayout')
<?php
use Carbon\Carbon;
?>
@section('content')
<div class="container mt-4 card">
    <h3 class="p-4">Danh sách giỏ hàng</h3>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Người dùng</th>
                <th>Tổng sản phẩm</th>
                <th>Tổng tiền</th>
                <th>Ngày cập nhật</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($carts as $cart)
                <tr>
                    <td>{{ $cart->id }}</td>
                    <td>{{ $cart->user->username ?? 'N/A' }}</td>
                    <td>{{ $cart->items->sum('quantity') }}</td>
                    <td>{{ number_format($cart->items->sum(fn($i) => $i->price * $i->quantity)) }}₫</td>
                    <td>{{ $cart->created_at->format('Y/m/d H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.carts.show', $cart->id) }}" class="btn btn-sm btn-primary">👁️</a>
                        <form method="POST" action="{{ route('admin.carts.destroy', $cart->id) }}" class="d-inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Xóa giỏ hàng này?')" class="btn btn-sm btn-danger">🗑️</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        {{-- {{ $carts->links() }} --}}
    </div>
</div>
@endsection
