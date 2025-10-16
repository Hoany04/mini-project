@extends('layouts.AdminLayout')

@section('content')
<div class="container mt-4 card">
    <h3>Danh sách đơn hàng</h3>

    @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

    <form method="GET" class="row mb-3">
        <div class="col-md-4">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Tìm theo tên hoặc email...">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select" onchange="this.form.submit()">
                <option value="">-- Trạng thái --</option>
                @foreach(['pending'=>'Chờ xử lý','paid'=>'Đã thanh toán','shipped'=>'Đang giao','completed'=>'Hoàn tất','cancelled'=>'Hủy'] as $key => $label)
                    <option value="{{ $key }}" {{ request('status')==$key?'selected':'' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>
    </form>

    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Người dùng</th>
                <th>Tổng tiền</th>
                <th>Mã giảm giá</th>
                <th>Trạng thái</th>
                <th>Ngày đặt</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $key=>$order)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $order->user->username ?? 'N/A' }}</td>
                    <td>{{ number_format($order->total_amount) }}₫</td>
                    <td>{{ $order->coupon->code ?? '-' }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}">
                            @csrf @method('PUT')
                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                @foreach(['pending','paid','shipped','completed','cancelled'] as $st)
                                    <option value="{{ $st }}" {{ $order->status==$st?'selected':'' }}>{{ ucfirst($st) }}</option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary">Xem</a>
                        <form method="POST" action="{{ route('admin.orders.destroy', $order->id) }}" class="d-inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Xóa đơn hàng này?')" class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $orders->links() }}
</div>
@endsection
