@extends('layouts.AdminLayout')

@section('content')
<div class="container card">
    <h3 class="p-4">Chi tiết giao dịch #{{ $transaction->id }}</h3>

    <ul class="list-group">
        <li class="list-group-item"><strong>Đơn hàng:</strong> #{{ $transaction->order_id }}</li>
        <li class="list-group-item"><strong>Phương thức:</strong> {{ $transaction->paymentMethod->name }}</li>
        <li class="list-group-item"><strong>Số tiền:</strong> {{ number_format($transaction->amount) }} đ</li>
        <li class="list-group-item"><strong>Trạng thái:</strong> {{ $transaction->status }}</li>
        <li class="list-group-item"><strong>Mã giao dịch:</strong> {{ $transaction->transaction_code }}</li>
        <li class="list-group-item"><strong>Ngày tạo:</strong> {{ $transaction->created_at }}</li>
    </ul>

    <a href="{{ route('admin.payment-transactions.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
    <div class="mt-3"></div>
</div>
@endsection
