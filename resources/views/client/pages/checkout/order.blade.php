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
                                <li class="breadcrumb-item active" aria-current="page">checkout</li>
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

    <!-- checkout main wrapper start -->
    <div class="checkout-page-wrapper section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Checkout Login Coupon Accordion Start -->
                    <div class="checkoutaccordion" id="checkOutAccordion">
                        <div class="card">
                            <h6>Returning Customer? <span data-bs-toggle="collapse" data-bs-target="#logInaccordion">Click
                                        Here To Login</span></h6>
                            <div id="logInaccordion" class="collapse" data-parent="#checkOutAccordion">
                                <div class="card-body">
                                    <p>If you have shopped with us before, please enter your details in the boxes
                                        below. If you are a new customer, please proceed to the Billing &amp;
                                        Shipping section.</p>
                                    <div class="login-reg-form-wrap mt-20">
                                        <div class="row">
                                            <div class="col-lg-7 m-auto">
                                                <form action="#" method="post">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="single-input-item">
                                                                <input type="email" placeholder="Enter your Email" required />
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="single-input-item">
                                                                <input type="password" placeholder="Enter your Password" required />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="single-input-item">
                                                        <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                                            <div class="remember-meta">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="rememberMe" required />
                                                                    <label class="custom-control-label" for="rememberMe">Remember
                                                                        Me</label>
                                                                </div>
                                                            </div>

                                                            <a href="#" class="forget-pwd">Forget Password?</a>
                                                        </div>
                                                    </div>

                                                    <div class="single-input-item">
                                                        <button class="btn btn-sqr">Login</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <h6>Have A Coupon? <span data-bs-toggle="collapse" data-bs-target="#couponaccordion">Click
                                        Here To Enter Your Code</span></h6>
                            <div id="couponaccordion" class="collapse" data-parent="#checkOutAccordion">
                                <div class="card-body">
                                    <div class="cart-update-option">
                                        <div class="apply-coupon-wrapper">
                                            <form action="#" method="post" class=" d-block d-md-flex">
                                                <input type="text" placeholder="Enter Your Coupon Code" required />
                                                <button class="btn btn-sqr">Apply Coupon</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Checkout Login Coupon Accordion End -->
                </div>
            </div>
        <form action="{{ route('client.pages.checkout.store') }}" method="POST">
                @csrf
            <div class="row">
                <!-- Checkout Billing Details -->
                <div class="col-lg-6">
                    <div class="checkout-billing-details-wrap">
                        <h5 class="checkout-title">Billing Details</h5>
                        <div class="billing-form-wrap">
                            {{-- <div>
                                <div class="row">
                                    
                                    <div class="single-input-item">
                                        <label for="f_name" class="required">Full name</label>
                                        <input type="text" id="f_name" name="username"
                                            value="{{ old('username', $user->username ?? '') }}"
                                            placeholder="Full Name" required />
                                    </div>
                                    
                                </div>
                    
                                <div class="single-input-item">
                                    <label for="email" class="required">Email Address</label>
                                    <input type="email" id="email" name="email"
                                        value="{{ old('email', $user->email) }}"
                                        placeholder="Email Address" required />
                                </div>
                    
                                <div class="single-input-item">
                                    <label for="phone">Phone</label>
                                    <input type="text" id="phone" name="phone"
                                        value="{{ old('phone', $user->profile->phone ?? '') }}"
                                        placeholder="Phone" />
                                </div>
                    
                                <div class="single-input-item">
                                    <label for="country" class="required">Country</label>
                                    <input type="text" id="country" name="country"
                                        value="{{ old('country', $user->profile->country ?? '') }}"
                                        placeholder="Country" required />
                                </div>
                    
                                <div class="single-input-item">
                                    <label for="street-address" class="required mt-20">Street address</label>
                                    <input type="text" id="street-address" name="address"
                                        value="{{ old('address', $user->profile->address ?? '') }}"
                                        placeholder="Street address" required />
                                </div>
                    
                                <div class="single-input-item">
                                    <label for="town" class="required">City / Town</label>
                                    <input type="text" id="town" name="city"
                                        value="{{ old('city', $user->profile->city ?? '') }}"
                                        placeholder="City / Town" required />
                                </div>
                    
                                <div class="checkout-billing-details-wrap">
                                    <h5 class="checkout-title">Địa chỉ giao hàng</h5>
                            </div>     --}}
                                    {{-- Hiển thị địa chỉ mặc định --}}
                                    @if($defaultAddress)
                                        <div class="default-address mb-3 p-3 border rounded">
                                            <strong>{{ $defaultAddress->full_name }}</strong> - {{ $defaultAddress->phone }}<br>
                                            {{ $defaultAddress->address_detail }}, {{ $defaultAddress->ward }},
                                            {{ $defaultAddress->district }}, {{ $defaultAddress->province }}
                                        </div>
                                    @else
                                        <p>Chưa có địa chỉ mặc định. Hãy thêm địa chỉ giao hàng.</p>
                                    @endif
                                
                                    {{-- Chọn địa chỉ khác --}}
                                    <div class="mb-3">
                                        <label class="form-label">Chọn địa chỉ giao hàng</label>
                                        @foreach($addresses as $address)
                                            <div class="form-check">
                                                <input type="radio"
                                                       name="shipping_address_id"
                                                       id="address_{{ $address->id }}"
                                                       value="{{ $address->id }}"
                                                       class="form-check-input"
                                                       {{ $address->is_default ? 'checked' : '' }}>
                                                <label for="address_{{ $address->id }}" class="form-check-label">
                                                    <strong>{{ $address->full_name }}</strong> - {{ $address->phone }}<br>
                                                    <small>{{ $address->address_detail }}, {{ $address->ward }}, {{ $address->district }}, {{ $address->province }}</small>
                                                </label>
                                            </div>
                                        @endforeach
                                      </div>
                                      
                                      <div class="mb-3">
                                        <label for="delivery_note" class="form-label">Ghi chú giao hàng (tuỳ chọn)</label>
                                        <textarea name="delivery_note" id="delivery_note" class="form-control" rows="3"
                                                  placeholder="Ví dụ: Giao hàng trong giờ hành chính, gọi trước khi giao..."></textarea>
                                    </div>
                                
                                    {{-- Nút mở modal thêm địa chỉ --}}
                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addAddressModal">
                                        + Thêm địa chỉ mới
                                    </button>
                                {{-- </div> --}}
                        </div>
                    </div>
                    
                </div>

                <!-- Order Summary Details -->
                <div class="col-lg-6">
                
                    {{-- <div class="col-lg-6"> --}}
                        <div class="order-summary-details">
                            <h5 class="checkout-title">Your Order Summary</h5>
                
                            {{-- hiển thị danh sách sản phẩm --}}
                            <div class="order-summary-content">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cart->items as $item)
                                            <tr>
                                                <td>{{ $item->product->name }} <strong>× {{ $item->quantity }}</strong></td>
                                                <td>{{ number_format($item->price * $item->quantity) }}đ</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>Tổng tạm tính</td>
                                            <td><strong>{{ number_format($cart->total_price) }}đ</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                
                            {{-- Chọn phương thức thanh toán --}}
                            <div class="order-payment-method">

                                <tr>
                                    <td>Phương thức giao hàng</td>
                                    <td class="d-flex justify-content-center">
                                        <ul class="shipping-type">
                                            @foreach ($methods as $method)
                                                <li>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio"
                                                            id="shipping_{{ $method->id }}"
                                                            name="shipping_method_id"
                                                            value="{{ $method->id }}"
                                                            class="custom-control-input"
                                                            {{ $loop->first ? 'checked' : '' }} />
                                                        <label class="custom-control-label" for="shipping_{{ $method->id }}">
                                                            {{ $method->name }}:
                                                            {{ number_format($method->fee) }}đ
                                                        </label>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr><br>

                                <div class="custom-control custom-radio">
                                    <input type="radio" id="cashon" name="paymentmethod" value="cash" class="custom-control-input" checked>
                                    <label class="custom-control-label" for="cashon">Thanh toán khi nhận hàng</label> <br>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="paypalpayment" name="paymentmethod" value="paypal" class="custom-control-input">
                                    <label class="custom-control-label" for="paypalpayment">Thanh toán qua ví điện tử</label> <br>
                                </div>

                                <div class="single-payment-method">
                                    <div class="payment-method-name">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="stripe" name="paymentmethod" value="stripe" class="custom-control-input" />
                                            <label class="custom-control-label" for="stripe">
                                                Thanh toán qua Stripe 
                                                <img src="{https://upload.wikimedia.org/wikipedia/commons/thumb/f/f5/Stripe_logo%2C_revised_2016.svg/2560px-Stripe_logo%2C_revised_2016.svg.png}" 
                                                     alt="Stripe" style="width:60px; margin-left:5px;">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="payment-method-details" data-method="stripe">
                                        <p>Thanh toán an toàn bằng thẻ Visa, Mastercard qua Stripe.</p>
                                    </div>
                                </div>
                                
                                
                                    <div class="custom-control custom-checkbox mb-20">
                                        <input type="checkbox" class="custom-control-input" id="terms" required />
                                        <label class="custom-control-label" for="terms">I have read and agree to
                                            the website terms and conditions.</label>
                                    </div>
                                    
                                <div class="summary-footer-area">
                                    <button type="submit" class="btn btn-sqr">Đặt hàng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Modal thêm địa chỉ -->
        <div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('client.pages.addresses.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="addAddressModalLabel">Thêm địa chỉ giao hàng</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-2">
                                <label>Họ tên</label>
                                <input type="text" name="full_name" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label>Số điện thoại</label>
                                <input type="text" name="phone" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label>Tỉnh/Thành phố</label>
                                <input type="text" name="province" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label>Quận/Huyện</label>
                                <input type="text" name="district" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label>Phường/Xã</label>
                                <input type="text" name="ward" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label>Địa chỉ chi tiết</label>
                                <input type="text" name="address_detail" class="form-control" required>
                            </div>
                            <div class="form-check mb-2">
                                <input type="checkbox" name="is_default" class="form-check-input" id="is_default" value="1">
                                <label class="form-check-label" for="is_default">Đặt làm mặc định</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary">Lưu địa chỉ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- checkout main wrapper end -->
</main>

<!-- Scroll to top start -->
<div class="scroll-top not-visible">
    <i class="fa fa-angle-up"></i>
</div>
<!-- Scroll to Top End -->

@endsection