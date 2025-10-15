@extends('layouts.AdminLayout')

@section('content')
<div class="container mt-4 card">
    <h4 class="mb-3">Danh sách mã giảm giá</h4>

    <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary mb-3">+ Thêm mã mới</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th>ID</th>
                <th>Mã</th>
                <th>Loại</th>
                <th>Giá trị</th>
                <th>Đơn tối thiểu</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($coupons as $key=>$coupon)
                <tr class="align-middle text-center">
                    <td>{{ $key+1 }}</td>
                    <td>{{ $coupon->code }}</td>
                    <td>{{ ucfirst($coupon->discount_type) }}</td>
                    <td>{{ $coupon->discount_value }}</td>
                    <td>{{ number_format($coupon->min_order_value, 0, ',', '.') }}đ</td>
                    <td>{{ $coupon->start_date }}</td>
                    <td>{{ $coupon->end_date }}</td>
                    <td>
                        <span class="badge bg-{{ $coupon->status === 'active' ? 'success' : ($coupon->status === 'inactive' ? 'secondary' : 'danger') }}">
                            {{ ucfirst($coupon->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST" style="display:inline-block">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Xóa mã này?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $coupons->links() }}
</div>
@endsection
