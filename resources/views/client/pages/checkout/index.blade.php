@extends('layouts.ClientLayout')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">🧾 Order history</h2>

    @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($orders->isEmpty())
        <div class="alert alert-info text-center">
            You don't have any orders yet.
        </div>
    @else
        <div class="table-responsive shadow-sm">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Order code</th>
                        <th>Date of booking</th>
                        <th>Total amount</th>
                        <th>Pay</th>
                        <th>Status</th>
                        <th>Act</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        @php
                            $payment = $order->paymentTransactions->first();
                        @endphp
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ number_format($order->total_amount, 0, ',', '.') }}₫</td>
                            <td>{{ $payment->paymentMethod->name ?? 'Unpaid' }}</td>
                            <td>
                                @if($order->status === 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($order->status === 'paid')
                                    <span class="badge bg-success">Paid</span>
                                @elseif($order->status === 'shipped')
                                    <span class="badge bg-info text-dark">Shipped</span>
                                @elseif($order->status === 'completed')
                                    <span class="badge bg-primary">Completed</span>
                                @else
                                    <span class="badge bg-danger">Cancelled</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('client.pages.checkout.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                    See details
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
