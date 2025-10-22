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
                            <td id="final-total" class="text-end text-danger fs-5">{{ number_format($cart->total_price) }}đ</td>
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
<!-- Scroll to Top End -->

<!-- Quick view modal start -->
{{-- <div class="modal" id="quick_view">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <!-- product details inner end -->
                <div class="product-details-inner">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="product-large-slider">
                                <div class="pro-large-img img-zoom">
                                    <img src="assets/img/product/product-details-img1.jpg" alt="product-details" />
                                </div>
                            </div>
                            <div class="pro-nav slick-row-10 slick-arrow-style">
                                <div class="pro-nav-thumb">
                                    <img src="assets/img/product/product-details-img1.jpg" alt="product-details" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="product-details-des">
                                <div class="manufacturer-name">
                                    <a href="product-details.html">HasTech</a>
                                </div>
                                <h3 class="product-name">Handmade Golden Necklace</h3>
                                <div class="ratings d-flex">
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <div class="pro-review">
                                        <span>1 Reviews</span>
                                    </div>
                                </div>
                                <div class="price-box">
                                    <span class="price-regular">$70.00</span>
                                    <span class="price-old"><del>$90.00</del></span>
                                </div>
                                <h5 class="offer-text"><strong>Hurry up</strong>! offer ends in:</h5>
                                <div class="product-countdown" data-countdown="2022/12/20"></div>
                                <div class="availability">
                                    <i class="fa fa-check-circle"></i>
                                    <span>200 in stock</span>
                                </div>
                                <p class="pro-desc">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna.</p>
                                <div class="quantity-cart-box d-flex align-items-center">
                                    <h6 class="option-title">qty:</h6>
                                    <div class="quantity">
                                        <div class="pro-qty"><input type="text" value="1"></div>
                                    </div>
                                    <div class="action_link">
                                        <a class="btn btn-cart2" href="#">Add to cart</a>
                                    </div>
                                </div>
                                <div class="useful-links">
                                    <a href="#" data-bs-toggle="tooltip" title="Compare"><i
                                        class="pe-7s-refresh-2"></i>compare</a>
                                    <a href="#" data-bs-toggle="tooltip" title="Wishlist"><i
                                        class="pe-7s-like"></i>wishlist</a>
                                </div>
                                <div class="like-icon">
                                    <a class="facebook" href="#"><i class="fa fa-facebook"></i>like</a>
                                    <a class="twitter" href="#"><i class="fa fa-twitter"></i>tweet</a>
                                    <a class="pinterest" href="#"><i class="fa fa-pinterest"></i>save</a>
                                    <a class="google" href="#"><i class="fa fa-google-plus"></i>share</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- product details inner end -->
            </div>
        </div>
    </div>
</div> --}}
<!-- Quick view modal end -->

<!-- offcanvas mini cart start -->
{{-- <div class="offcanvas-minicart-wrapper">
    <div class="minicart-inner">
        <div class="offcanvas-overlay"></div>
        <div class="minicart-inner-content">
            <div class="minicart-close">
                <i class="pe-7s-close"></i>
            </div>
            <div class="minicart-content-box">
                <div class="minicart-item-wrapper">
                    <ul>
                        <li class="minicart-item">
                            <div class="minicart-thumb">
                                <a href="product-details.html">
                                    <img src="assets/img/cart/cart-1.jpg" alt="product">
                                </a>
                            </div>
                            <div class="minicart-content">
                                <h3 class="product-name">
                                    <a href="product-details.html">Dozen White Botanical Linen Dinner Napkins</a>
                                </h3>
                                <p>
                                    <span class="cart-quantity">1 <strong>&times;</strong></span>
                                    <span class="cart-price">$100.00</span>
                                </p>
                            </div>
                            <button class="minicart-remove"><i class="pe-7s-close"></i></button>
                        </li>
                        <li class="minicart-item">
                            <div class="minicart-thumb">
                                <a href="product-details.html">
                                    <img src="assets/img/cart/cart-2.jpg" alt="product">
                                </a>
                            </div>
                            <div class="minicart-content">
                                <h3 class="product-name">
                                    <a href="product-details.html">Dozen White Botanical Linen Dinner Napkins</a>
                                </h3>
                                <p>
                                    <span class="cart-quantity">1 <strong>&times;</strong></span>
                                    <span class="cart-price">$80.00</span>
                                </p>
                            </div>
                            <button class="minicart-remove"><i class="pe-7s-close"></i></button>
                        </li>
                    </ul>
                </div>

                <div class="minicart-pricing-box">
                    <ul>
                        <li>
                            <span>sub-total</span>
                            <span><strong>$300.00</strong></span>
                        </li>
                        <li>
                            <span>Eco Tax (-2.00)</span>
                            <span><strong>$10.00</strong></span>
                        </li>
                        <li>
                            <span>VAT (20%)</span>
                            <span><strong>$60.00</strong></span>
                        </li>
                        <li class="total">
                            <span>total</span>
                            <span><strong>$370.00</strong></span>
                        </li>
                    </ul>
                </div>

                <div class="minicart-button">
                    <a href="{{ route('client.pages.cart.index') }}"><i class="fa fa-shopping-cart"></i> View Cart</a>
                    <a href="cart.html"><i class="fa fa-share"></i> Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!-- offcanvas mini cart end -->

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