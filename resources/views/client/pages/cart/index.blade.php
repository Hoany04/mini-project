@extends('layouts.ClientLayout')

@section('content')

<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="shop.html">shop</a></li>
                                <li class="breadcrumb-item active" aria-current="page">cart</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- breadcrumb area end -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="container py-5">
        <h2 class="mb-4">Giỏ hàng</h2>
        @if($cart && $cart->items->count())
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tạm tính</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart->items as $item)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('storage/' .$item->product->images->first()->image_url) }}" width="70" class="me-3 rounded">
                                <div>
                                    <strong>{{ $item->product->name }}</strong><br>
                                    @if($item->variant_text)
                                        <small>{{ $item->variant_text }}</small>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>{{ number_format($item->price, 0, ',', '.') }}₫</td>
                        <td>
                            <form action="{{ route('client.pages.cart.update', $item->id) }}" method="POST" class="d-flex">
                                @csrf @method('PUT')
                                <input type="number" name="quantity" class="form-control text-center cart-quantity"
                                data-item-id="{{ $item->id }}" value="{{ $item->quantity }}" min="1" class="form-control w-50 me-2">
                                <button class="btn btn-sm btn-outline-success">Cập nhật</button>
                            </form>
                        </td>
                        <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }}₫</td>
                        <td>
                            <form action="{{ route('client.pages.cart.destroy', $item->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="cart-coupon-section">
                <form action="{{ route('client.pages.coupon.apply') }}" method="POST" class="d-flex">
                    @csrf
                    <input type="text" name="coupon" class="form-control" placeholder="Nhập mã giảm giá">
                    <button type="submit" class="btn btn-primary ms-2">Áp dụng</button>
                </form>

                @if(session('coupon'))
                    <div class="alert alert-success mt-2">
                        Mã <strong>{{ session('coupon.code') }}</strong> được áp dụng! Giảm
                        <span class="text-danger">{{ number_format(session('coupon.discount'), 0, ',', '.') }}₫</span>
                        <form action="{{ route('client.pages.coupon.remove') }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-link text-danger">Xóa</button>
                        </form>
                    </div>
                @endif

                @error('coupon')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <br>
                <div class="cart-summary mt-4">
                    <h5>Tóm tắt đơn hàng</h5>
                    <table class="table">
                        <tr>
                            <td>Tổng tiền sản phẩm:</td>
                            <td id="cart-total" class="text-end">{{ number_format($cart->items->sum(fn($i) => $i->price * $i->quantity)) }}đ</td>
                        </tr>

                        @if($cart->coupon)
                            <tr>
                                <td>Mã giảm giá:</td>
                                <td class="text-end text-success">{{ $cart->coupon->code }} ({{ $cart->coupon->discount_type == 'percent' ? $cart->coupon->discount_value . '%' : number_format($cart->coupon->discount_value) . 'đ' }})</td>
                            </tr>
                            <tr>
                                <td>Giảm giá:</td>
                                <td id="discount" class="text-end text-danger">-{{ number_format($cart->discount) }}đ</td>
                            </tr>
                        @endif

                        <tr class="fw-bold border-top">
                            <td>Tổng thanh toán:</td>
                            <td id="final-total" class="text-end text-danger fs-5">
                                @if(session('coupon'))
                                    {{ number_format(session('coupon.new_total'), 0, ',', ',') }}đ
                                @else
                                    {{ number_format($cart->total_price, 0, ',', ',') }}đ
                                @endif
                            </td>
                        </tr>
                    </table>

                    <a href="{{ route('client.pages.checkout.order') }}" class="btn btn-danger w-100">Tiến hành thanh toán</a>
                </div>
        @else
            <p>Giỏ hàng của bạn đang trống.</p>
        @endif
    </div>
</main>

<!-- Scroll to top start -->
<div class="scroll-top not-visible">
    <i class="fa fa-angle-up"></i>
</div>

@endsection
@section('js')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const quantityInputs = document.querySelectorAll(".cart-quantity");

        quantityInputs.forEach(input => {
            input.addEventListener("change", function() {
                const itemId = this.dataset.itemId;
                const quantity = this.value;

                fetch("{{ route('client.pages.cart.updateAjax') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ item_id: itemId, quantity: quantity })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        document.querySelector("#cart-total").innerText = data.cart_total + "đ";
                        document.querySelector("#discount").innerText = "-" + data.discount + "đ";
                        document.querySelector("#final-total").innerText = data.final_total + "đ";
                    }
                });
            });
        });
    });
    </script>
@endsection
