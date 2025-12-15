@extends('layouts.AdminLayout')
<?php
use Carbon\Carbon;
?>
@section('content')
<div class="container card">
    <h3 class="p-4">List of payment transactions</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Order code</th>
                <th>Method</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Creation date</th>
                <th>Operation</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $key=>$item)
            <tr>
                <td>{{ ($transactions->currentPage() - 1) * $transactions->perPage() + $key + 1 }}</td>
                <td>#{{ $item->order_id }}</td>
                <td>{{ $item->paymentMethod->name }}</td>
                <td>{{ number_format($item->amount) }} đ</td>

                <td>
                    <span class="badge bg-{{ $item->status === 'paid' ? 'success' : 'warning' }}">
                        {{ $item->status }}
                    </span>
                </td>

                <td>{{ $item->created_at->format('Y/m/d H:i') }}</td>
                <td>
                    <a href="{{ route('admin.payment-transactions.show', $item->id) }}" class="btn btn-info btn-sm">
                        👁️
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        {{ $transactions->links() }}
    </div>
</div>
@endsection
