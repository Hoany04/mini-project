@extends('layouts.AdminLayout')

@section('content')
<div class="container mt-4 card">
    <h3 class="p-4">Chi tiết đơn hàng #{{ $order->id }}</h3>

    <div class="mb-3">
        <strong>Khách hàng:</strong> {{ $order->user->username ?? 'N/A' }} <br>
        <strong>Email:</strong> {{ $order->user->email ?? 'N/A' }} <br>
        <strong>Trạng thái:</strong> <span class="badge bg-info text-dark">{{ ucfirst($order->status) }}</span>
    </div>

    <h5>Sản phẩm trong đơn hàng</h5>
    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Tổng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->product->name ?? 'Đã xóa' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price) }}₫</td>
                    <td>{{ number_format($item->price * $item->quantity) }}₫</td>
                </tr>
            @endforeach
            <tr>
                <th colspan="4" class="text-end">Tổng tiền hàng:</th>
                <th>{{ number_format($order->items->sum(fn($i) => $i->price * $i->quantity), 0, ',', '.') }}₫</th>
            </tr>
            @if ($order->coupon)
                <tr>
                    <th colspan="4" class="text-end">Giảm giá ({{ $order->coupon->code }}):</th>
                    <th>-{{ $order->coupon->discount_value }}%</th>
                </tr>
            @endif
            <tr>
                <th colspan="4" class="text-end">Phí vận chuyển</th>
                <th>{{ number_format($order->shipping->method->fee ?? 0) }}₫</th>
            </tr>
        </tbody>
    </table>

    <h5 class="text-end mt-3">
        Tổng cộng: <span class="text-danger fw-bold">{{ number_format($order->total_amount) }}₫</span>
    </h5>

    <div class="card mt-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Thông tin giao hàng</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.orders.updateShipping', $order->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Địa chỉ giao hàng</label>
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
                        <p class="text-muted">Chưa có địa chỉ giao hàng</p>
                    @endif
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Phương thức vận chuyển</label>
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
                        <label>Phí vận chuyển</label><br>
                        <div class="border rounded p-2 bg-light">
                            <th>{{ number_format($order->shipping->method->fee ?? 0) }}₫</th>
                            {{-- <input type="number" name="shipping_fee" class="form-control"
                                value="{{ optional($order->shipping)->shipping_fee }}"> --}}
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Mã vận đơn</label>
                    <input type="text" name="tracking_number" class="form-control"
                           value="#{{ ($order->id) }}">
                </div>

                <div class="mb-3">
                    <label>Ghi chú giao hàng</label>
                    <textarea name="delivery_note" class="form-control">{{ optional($order->shipping)->delivery_note }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Trạng thái giao hàng</label>
                    <select name="status" class="form-select">
                        @php
                            $statuses = ['pending' => 'Chờ xử lý', 'shipping' => 'Đang giao', 'delivered' => 'Đã giao', 'cancelled' => 'Đã hủy'];
                        @endphp
                        @foreach($statuses as $key => $label)
                            <option value="{{ $key }}"
                                {{ optional($order->shipping)->status == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Cập nhật</button>
            </form>
        </div>
    </div>

    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
</div>
@endsection
