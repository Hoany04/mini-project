@extends('layouts.AdminLayout')

@section('content')
<div class="container mt-4 card">
    <h4 class="mb-3 p-4">Danh sách mã giảm giá</h4>
    <div class="text-end">
        <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary mb-3">+ Thêm mã mới</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr class="text-center">
                <th>ID</th>
                <th>Mã</th>
                <th>Loại</th>
                <th>Giá trị</th>
                <th>Đơn tối thiểu</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Trạng thái</th>
                <th width="18%">Hành động</th>
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
                        <span class="badge bg-{{ $coupon->status->badgeColor() }}">
                            {{ $coupon->status->label() }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="btn btn-sm btn-warning">✏️</a>
                        <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST" style="display:inline-block">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Xóa mã này?')">🗑️</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        {{ $coupons->links() }}
    </div>
</div>
@endsection
