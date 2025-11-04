@extends('layouts.AdminLayout')

@section('content')
<h3>Danh sách giao dịch thanh toán</h3>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Mã đơn hàng</th>
            <th>Phương thức</th>
            <th>Số tiền</th>
            <th>Status</th>
            <th>Ngày tạo</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($transactions as $key=>$item)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>#{{ $item->order_id }}</td>
            <td>{{ $item->paymentMethod->name }}</td>
            <td>{{ number_format($item->amount) }} đ</td>

            <td>
                <span class="badge bg-{{ $item->status === 'paid' ? 'success' : 'warning' }}">
                    {{ $item->status }}
                </span>
            </td>

            <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
            <td>
                <a href="{{ route('admin.payment-transactions.show', $item->id) }}" class="btn btn-info btn-sm">
                    Xem
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $transactions->links() }}
@endsection
