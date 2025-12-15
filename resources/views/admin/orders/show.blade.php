@extends('layouts.AdminLayout')

@section('content')
<div class="container mt-4 card">
    <h3 class="p-4">Order details #{{ $order->id }}</h3>

    <div class="mb-3">
        <strong>Client:</strong> {{ $order->user->username ?? 'N/A' }} <br>
        <strong>Email:</strong> {{ $order->user->email ?? 'N/A' }} <br>
        <strong>Status:</strong> <span class="badge bg-info text-dark">{{ ucfirst($order->status) }}</span>
    </div>

    <h5>Products in the order</h5>
    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->product->name ?? 'Deleted' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price) }}₫</td>
                    <td>{{ number_format($item->price * $item->quantity) }}₫</td>
                </tr>
            @endforeach
            <tr>
                <th colspan="4" class="text-end">Total amount of goods:</th>
                <th>{{ number_format($order->items->sum(fn($i) => $i->price * $i->quantity), 0, ',', '.') }}₫</th>
            </tr>
            @if ($order->coupon)
                <tr>
                    <th colspan="4" class="text-end">Discount ({{ $order->coupon->code }}):</th>
                    <th>-{{ $order->coupon->discount_value }}%</th>
                </tr>
            @endif
            <tr>
                <th colspan="4" class="text-end">Shipping fee</th>
                <th>{{ number_format($order->shipping->method->fee ?? 0) }}₫</th>
            </tr>
        </tbody>
    </table>

    <h5 class="text-end mt-3">
        Total: <span class="text-danger fw-bold">{{ number_format($order->total_amount) }}₫</span>
    </h5>

    <div class="card mt-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Delivery information</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.orders.updateShipping', $order->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Delivery address</label>
                    @if($order->shipping && $order->shipping->shippingAddress)
                        <input type="hidden" name="shipping_address_id" value="{{ $order->shipping->shippingAddress->id }}">
                    @endif
                    @if($order->shipping && $order->shipping->shippingAddress)
                        <div class="border rounded p-2 bg-light">
                            <strong>{{ $order->shipping->shippingAddress->full_name }}</strong><br>
                            {{ $order->shipping->shippingAddress->phone }}<br>
                            {{ $order->shipping->shippingAddress->address_detail }},
                            {{ $order->shipping->shippingAddress->ward }},
                            {{ $order->shipping->shippingAddress->district }},
                            {{ $order->shipping->shippingAddress->province }}
                        </div>
                    @else
                        <p class="text-muted">No delivery address available.</p>
                    @endif
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Shipping method</label>
                        <select name="shipping_method_id" class="form-select">
                            @foreach($shippingMethods as $method)
                                <option value="{{ $method->id }}"
                                    {{ optional($order->shipping)->shipping_method_id == $method->id ? 'selected' : '' }}>
                                    {{ $method->name }} ({{ number_format($method->fee) }}đ)
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Shipping fee</label><br>
                        <div class="border rounded p-2 bg-light">
                            <th>{{ number_format($order->shipping->method->fee ?? 0) }}₫</th>
                            {{-- <input type="number" name="shipping_fee" class="form-control"
                                value="{{ optional($order->shipping)->shipping_fee }}"> --}}
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Tracking number</label>
                    <input type="text" name="tracking_number" class="form-control"
                           value="#{{ ($order->id) }}">
                </div>

                <div class="mb-3">
                    <label>Delivery notes</label>
                    <textarea name="delivery_note" class="form-control">{{ optional($order->shipping)->delivery_note }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Delivery status</label>
                    <select name="status" class="form-select">
                        @php
                            $statuses = ['pending' => 'pending', 'shipping' => 'shipping', 'delivered' => 'delivered', 'cancelled' => 'cancelled'];
                        @endphp
                        @foreach($statuses as $key => $label)
                            <option value="{{ $key }}"
                                {{ optional($order->shipping)->status == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Update</button>
            </form>
        </div>
    </div>

    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary mt-3">Come back</a>
</div>
@endsection
