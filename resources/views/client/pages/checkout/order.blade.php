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
                    
                                {{-- <div class="single-input-item">
                                    <label for="postcode" class="required">Postcode / ZIP</label>
                                    <input type="text" id="postcode" name="zipcode"
                                        value="{{ old('zipcode', $user->profile->zipcode ?? '') }}"
                                        placeholder="Postcode / ZIP" required />
                                </div> --}}
                            </form>
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
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="cashon" name="paymentmethod" value="cash" class="custom-control-input" checked>
                                    <label class="custom-control-label" for="cashon">Thanh toán khi nhận hàng</label> <br>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="paypalpayment" name="paymentmethod" value="paypal" class="custom-control-input">
                                    <label class="custom-control-label" for="paypalpayment">PayPal</label> <br>
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
    </div>
    <!-- checkout main wrapper end -->
</main>

<!-- Scroll to top start -->
<div class="scroll-top not-visible">
    <i class="fa fa-angle-up"></i>
</div>
<!-- Scroll to Top End -->

@endsection