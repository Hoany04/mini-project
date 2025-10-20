@extends('layouts.AdminLayout')

@section('content')
<h3>Danh sách giỏ hàng</h3>
<div class="container mt-4 card">

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
                    <td>{{ $cart->updated_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.carts.show', $cart->id) }}" class="btn btn-sm btn-primary">Chi tiết</a>
                        <form method="POST" action="{{ route('admin.carts.destroy', $cart->id) }}" class="d-inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Xóa giỏ hàng này?')" class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- {{ $carts->links() }} --}}
</div>
@endsection
