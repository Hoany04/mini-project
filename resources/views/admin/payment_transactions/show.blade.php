@extends('layouts.AdminLayout')

@section('content')
<div class="container card">
    <h3 class="p-4">Transaction details #{{ $transaction->id }}</h3>

    <ul class="list-group">
        <li class="list-group-item"><strong>Order:</strong> #{{ $transaction->order_id }}</li>
        <li class="list-group-item"><strong>Method:</strong> {{ $transaction->paymentMethod->name }}</li>
        <li class="list-group-item"><strong>Amount:</strong> {{ number_format($transaction->amount) }} đ</li>
        <li class="list-group-item"><strong>Status:</strong> {{ $transaction->status }}</li>
        <li class="list-group-item"><strong>Transaction code:</strong> {{ $transaction->transaction_code }}</li>
        <li class="list-group-item"><strong>Creation date:</strong> {{ $transaction->created_at }}</li>
    </ul>

    <a href="{{ route('admin.payment-transactions.index') }}" class="btn btn-secondary mt-3">Come back</a>
    <div class="mt-3"></div>
</div>
@endsection
