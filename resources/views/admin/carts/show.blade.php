@extends('layouts.AdminLayout')

@section('content')
<div class="container mt-4 card">
    <h3 class="p-4">Cart details #{{ $cart->id }}</h3>

    <div class="mb-3">
        <strong>Users:</strong> {{ $cart->user->username ?? 'Unknown' }} <br>
        <strong>Email:</strong> {{ $cart->user->email ?? 'N/A' }}
    </div>

    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Variant</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart->items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->product->name ?? 'Deleted product' }}</td>
                    <td>{{ $item->variant_text ?? '-' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price) }}₫</td>
                    <td>{{ number_format($item->price * $item->quantity) }}₫</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h5 class="text-end mt-3">Total:
        <span class="text-danger fw-bold">
            {{ number_format($cart->items->sum(fn($i) => $i->price * $i->quantity)) }}₫
        </span>
    </h5>

    <a href="{{ route('admin.carts.index') }}" class="btn btn-secondary mt-3">Come back</a>
    <div class="mt-3"></div>
</div>
@endsection
