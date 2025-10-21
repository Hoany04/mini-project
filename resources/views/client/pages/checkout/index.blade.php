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
            <div class="row">
                <!-- Checkout Billing Details -->
                <div class="col-lg-6">
                    <div class="checkout-billing-details-wrap">
                        <h5 class="checkout-title">Billing Details</h5>
                        <div class="billing-form-wrap">
                            <form action="#">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="f_name" class="required">First Name</label>
                                            <input type="text" id="f_name" placeholder="First Name" required />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="l_name" class="required">Last Name</label>
                                            <input type="text" id="l_name" placeholder="Last Name" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="single-input-item">
                                    <label for="email" class="required">Email Address</label>
                                    <input type="email" id="email" placeholder="Email Address" required />
                                </div>

                                <div class="single-input-item">
                                    <label for="com-name">Company Name</label>
                                    <input type="text" id="com-name" placeholder="Company Name" />
                                </div>

                                <div class="single-input-item">
                                    <label for="country" class="required">Country</label>
                                    <select name="country nice-select" id="country">
                                        <option value="Afghanistan">Afghanistan</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="Armenia">Armenia</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="India">India</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="England">England</option>
                                        <option value="London">London</option>
                                        <option value="London">London</option>
                                        <option value="Chaina">China</option>
                                    </select>
                                </div>

                                <div class="single-input-item">
                                    <label for="street-address" class="required mt-20">Street address</label>
                                    <input type="text" id="street-address" placeholder="Street address Line 1" required />
                                </div>

                                <div class="single-input-item">
                                    <input type="text" placeholder="Street address Line 2 (Optional)" />
                                </div>

                                <div class="single-input-item">
                                    <label for="town" class="required">Town / City</label>
                                    <input type="text" id="town" placeholder="Town / City" required />
                                </div>

                                <div class="single-input-item">
                                    <label for="state">State / Divition</label>
                                    <input type="text" id="state" placeholder="State / Divition" />
                                </div>

                                <div class="single-input-item">
                                    <label for="postcode" class="required">Postcode / ZIP</label>
                                    <input type="text" id="postcode" placeholder="Postcode / ZIP" required />
                                </div>

                                <div class="single-input-item">
                                    <label for="phone">Phone</label>
                                    <input type="text" id="phone" placeholder="Phone" />
                                </div>

                                <div class="checkout-box-wrap">
                                    <div class="single-input-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="create_pwd">
                                            <label class="custom-control-label" for="create_pwd">Create an
                                                account?</label>
                                        </div>
                                    </div>
                                    <div class="account-create single-form-row">
                                        <p>Create an account by entering the information below. If you are a
                                            returning customer please login at the top of the page.</p>
                                        <div class="single-input-item">
                                            <label for="pwd" class="required">Account Password</label>
                                            <input type="password" id="pwd" placeholder="Account Password" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="checkout-box-wrap">
                                    <div class="single-input-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="ship_to_different">
                                            <label class="custom-control-label" for="ship_to_different">Ship to a
                                                different address?</label>
                                        </div>
                                    </div>
                                    <div class="ship-to-different single-form-row">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="single-input-item">
                                                    <label for="f_name_2" class="required">First Name</label>
                                                    <input type="text" id="f_name_2" placeholder="First Name" required />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="single-input-item">
                                                    <label for="l_name_2" class="required">Last Name</label>
                                                    <input type="text" id="l_name_2" placeholder="Last Name" required />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="single-input-item">
                                            <label for="email_2" class="required">Email Address</label>
                                            <input type="email" id="email_2" placeholder="Email Address" required />
                                        </div>

                                        <div class="single-input-item">
                                            <label for="com-name_2">Company Name</label>
                                            <input type="text" id="com-name_2" placeholder="Company Name" />
                                        </div>

                                        <div class="single-input-item">
                                            <label for="country_2" class="required">Country</label>
                                            <select name="country" id="country_2">
                                                <option value="Bangladesh">Bangladesh</option>
                                                <option value="India">India</option>
                                                <option value="Pakistan">Pakistan</option>
                                                <option value="England">England</option>
                                                <option value="London">London</option>
                                                <option value="London">London</option>
                                                <option value="Chaina">Chaina</option>
                                            </select>
                                        </div>

                                        <div class="single-input-item">
                                            <label for="street-address_2" class="required mt-20">Street address</label>
                                            <input type="text" id="street-address_2" placeholder="Street address Line 1" required />
                                        </div>

                                        <div class="single-input-item">
                                            <input type="text" placeholder="Street address Line 2 (Optional)" />
                                        </div>

                                        <div class="single-input-item">
                                            <label for="town_2" class="required">Town / City</label>
                                            <input type="text" id="town_2" placeholder="Town / City" required />
                                        </div>

                                        <div class="single-input-item">
                                            <label for="state_2">State / Divition</label>
                                            <input type="text" id="state_2" placeholder="State / Divition" />
                                        </div>

                                        <div class="single-input-item">
                                            <label for="postcode_2" class="required">Postcode / ZIP</label>
                                            <input type="text" id="postcode_2" placeholder="Postcode / ZIP" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="single-input-item">
                                    <label for="ordernote">Order Note</label>
                                    <textarea name="ordernote" id="ordernote" cols="30" rows="3" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Order Summary Details -->
                <div class="col-lg-6">
                <form action="{{ route('client.pages.checkout.store') }}" method="POST">
                    @csrf
                
                    <div class="col-lg-6">
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