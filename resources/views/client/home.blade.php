@extends('layouts.ClientLayout')
@vite(['resources/js/app.js'])
@section('content')
    <section class="slider-area">
        <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
            <!-- single slider item start -->
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="{{ asset('assets/client/img/slider/home-sale.png') }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="hero-slider-content slide-1">
                                    {{-- <h2 class="slide-title">Flower Diamond<span>Collection</span></h2> --}}
                                    {{-- <h4 class="slide-desc">Budget Jewelry Starting At $295.99</h4> --}}
                                    {{-- <a href="shop.html" class="btn btn-hero">Read More</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- single slider item end -->

            <!-- single slider item start -->
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="{{ asset('assets/client/img/slider/home2-slide2.jpg') }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="hero-slider-content slide-2">
                                    <h2 class="slide-title">New Diamond<span>& Wedding Rings</span></h2>
                                    <h4 class="slide-desc">Avail 15% off on Making Charges for all Jewelry</h4>
                                    <a href="shop.html" class="btn btn-hero">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- single slider item start -->

            <!-- single slider item start -->
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="{{ asset('assets/client/img/slider/home1-slide1.jpg') }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="hero-slider-content slide-3">
                                    <h2 class="slide-title">Grace Designer<span>Jewelry</span></h2>
                                    <h4 class="slide-desc">Rings, Occasion Pieces, Pandora & More.</h4>
                                    <a href="shop.html" class="btn btn-hero">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- single slider item start -->
        </div>
    </section>
    <section class="slider-area">
        <!-- service policy area start -->
        <div class="service-policy">
            <div class="container">
                <div class="policy-block section-padding">
                    <div class="row mtn-30">
                        <div class="col-sm-6 col-lg-3">
                            <div class="policy-item">
                                <div class="policy-icon">
                                    <i class="pe-7s-plane"></i>
                                </div>
                                <div class="policy-content">
                                    <h6>Free Shipping</h6>
                                    <p>Free shipping all order</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="policy-item">
                                <div class="policy-icon">
                                    <i class="pe-7s-help2"></i>
                                </div>
                                <div class="policy-content">
                                    <h6>Support 24/7</h6>
                                    <p>Support 24 hours a day</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="policy-item">
                                <div class="policy-icon">
                                    <i class="pe-7s-back"></i>
                                </div>
                                <div class="policy-content">
                                    <h6>Money Return</h6>
                                    <p>30 days for free return</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="policy-item">
                                <div class="policy-icon">
                                    <i class="pe-7s-credit"></i>
                                </div>
                                <div class="policy-content">
                                    <h6>100% Payment Secure</h6>
                                    <p>We ensure secure payment</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- service policy area end -->

        <!-- product area start -->

            <section class="product-area section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <!-- section title start -->
                            <div class="section-title text-center">
                                <h2 class="title">our products</h2>
                                <p class="sub-title">Add our products to weekly lineup</p>
                            </div>
                            <!-- section title start -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="product-container">
                                <!-- product tab menu start -->
                                <div class="product-tab-menu">
                                    <ul class="nav justify-content-center">
                                        <li><a href="#tab1" class="active" data-bs-toggle="tab">Entertainment</a></li>
                                        <li><a href="#tab2" data-bs-toggle="tab">Storage</a></li>
                                        <li><a href="#tab3" data-bs-toggle="tab">Lying</a></li>
                                        <li><a href="#tab4" data-bs-toggle="tab">Tables</a></li>
                                    </ul>
                                </div>
                                <!-- product tab menu end -->


                                <!-- product tab content start -->
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="tab1">
                                        <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                                            @foreach ($products as $product)
                                            <!-- product item start -->
                                            <div class="product-item">
                                                <figure class="product-thumb">
                                                    @php
                                                        $imagePath = $product->images->first()
                                                            ? asset('storage/' . $product->images->first()->image_url)
                                                            : asset('images/no-image.png');
                                                    @endphp

                                                    <a href="#">
                                                        <img class="pri-img" src="{{ $imagePath }}"
                                                            alt="">
                                                        <img class="sec-img" src="{{ $imagePath }}"
                                                            alt="">
                                                    </a>

                                                    <div class="product-badge">
                                                        <div class="product-label new">
                                                            <span>new</span>
                                                        </div>
                                                        <div class="product-label discount">
                                                            <span>10%</span>
                                                        </div>
                                                    </div>
                                                    <div class="button-group">
                                                        <a href="wishlist.html" data-bs-toggle="tooltip"
                                                            data-bs-placement="left" title="Add to wishlist"><i
                                                                class="pe-7s-like"></i></a>
                                                        <a href="compare.html" data-bs-toggle="tooltip"
                                                            data-bs-placement="left" title="Add to Compare"><i
                                                                class="pe-7s-refresh-2"></i></a>
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#quick_view"><span data-bs-toggle="tooltip"
                                                                data-bs-placement="left" title="Quick View"><i
                                                                    class="pe-7s-search"></i></span></a>
                                                    </div>
                                                    <div class="cart-hover">
                                                        <button class="btn btn-cart">add to cart</button>
                                                    </div>
                                                </figure>
                                                <div class="product-caption text-center">
                                                    <div class="product-identity">
                                                        <p class="manufacturer-name"><a
                                                                href="{{ route('client.pages.products.detail', $product->id) }}">{{ $product->name }}</a></p>
                                                    </div>
                                                    <ul class="color-categories">
                                                        <li>
                                                            <a class="c-lightblue" href="#"
                                                                title="LightSteelblue"></a>
                                                        </li>
                                                        <li>
                                                            <a class="c-darktan" href="#" title="Darktan"></a>
                                                        </li>
                                                        <li>
                                                            <a class="c-grey" href="#" title="Grey"></a>
                                                        </li>
                                                        <li>
                                                            <a class="c-brown" href="#" title="Brown"></a>
                                                        </li>
                                                    </ul>
                                                    {{-- <h6 class="product-name">
                                                        <a href="product-details.html">{{ $product->name }}</a>
                                                    </h6> --}}
                                                    <div class="price-box">
                                                        <span
                                                            class="price-regular">{{ number_format($product->price, 0, ',', '.') }}₫</span>
                                                        <span class="price-old"><del>0đ</del></span>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            <!-- product item end -->
                                        </div>
                                    </div>
                                </div>
                                <!-- product tab content end -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <!-- product area end -->

        <!-- banner statistics area start -->
        <div class="banner-statistics-area">
            <div class="container">
                <div class="row row-20 mtn-20">
                    <div class="col-sm-6">
                        <figure class="banner-statistics mt-20">
                            <a href="#">
                                <img src="{{ asset('assets/client/img/banner/images.jpg') }}" alt="product banner" width="100" height="300">
                            </a>
                            <div class="banner-content text-right">
                                <h5 class="banner-text1">BEAUTIFUL</h5>
                                <h2 class="banner-text2">Wedding<span>Rings</span></h2>
                                <a href="shop.html" class="btn btn-text">Shop Now</a>
                            </div>
                        </figure>
                    </div>
                    <div class="col-sm-6">
                        <figure class="banner-statistics mt-20">
                            <a href="#">
                                <img src="{{ asset('assets/client/img/banner/images (1).jpg') }}" alt="product banner" width="100" height="300">
                            </a>
                            <div class="banner-content text-center">
                                <h5 class="banner-text1">EARRINGS</h5>
                                <h2 class="banner-text2">Tangerine Floral <span>Earring</span></h2>
                                <a href="shop.html" class="btn btn-text">Shop Now</a>
                            </div>
                        </figure>
                    </div>
                    <div class="col-sm-6">
                        <figure class="banner-statistics mt-20">
                            <a href="#">
                                <img src="{{ asset('assets/client/img/banner/images (2).jpg') }}" alt="product banner" width="100" height="300">
                            </a>
                            <div class="banner-content text-center">
                                <h5 class="banner-text1">NEW ARRIVALLS</h5>
                                <h2 class="banner-text2">Pearl<span>Necklaces</span></h2>
                                <a href="shop.html" class="btn btn-text">Shop Now</a>
                            </div>
                        </figure>
                    </div>
                    <div class="col-sm-6">
                        <figure class="banner-statistics mt-20">
                            <a href="#">
                                <img src="{{ asset('assets/client/img/banner/images (3).jpg') }}" alt="product banner" width="100" height="300">
                            </a>
                            <div class="banner-content text-right">
                                <h5 class="banner-text1">NEW DESIGN</h5>
                                <h2 class="banner-text2">Diamond<span>Jewelry</span></h2>
                                <a href="shop.html" class="btn btn-text">Shop Now</a>
                            </div>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
        <!-- banner statistics area end -->

        <!-- featured product area start -->
        <section class="feature-product section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- section title start -->
                        <div class="section-title text-center">
                            <h2 class="title">featured products</h2>
                            <p class="sub-title">Add featured products to weekly lineup</p>
                        </div>
                        <!-- section title start -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="product-carousel-4_2 slick-row-10 slick-arrow-style">
                            <!-- product item start -->
                            @foreach($products as $product)
                            <div class="product-item">
                                <figure class="product-thumb">
                                    @php
                                        $imagePath = $product->images->first()
                                            ? asset('storage/' . $product->images->first()->image_url)
                                            : asset('images/no-image.png');
                                    @endphp

                                    <a href="#">
                                        <img class="pri-img" src="{{ $imagePath }}"
                                            alt="">
                                        <img class="sec-img" src="{{ $imagePath }}"
                                            alt="">
                                    </a>

                                    <div class="product-badge">
                                        <div class="product-label new">
                                            <span>new</span>
                                        </div>
                                        <div class="product-label discount">
                                            <span>10%</span>
                                        </div>
                                    </div>
                                    <div class="button-group">
                                        <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                            title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                        <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                            title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span
                                                data-bs-toggle="tooltip" data-bs-placement="left"
                                                title="Quick View"><i class="pe-7s-search"></i></span></a>
                                    </div>
                                    <div class="cart-hover">
                                        <button class="btn btn-cart">add to cart</button>
                                    </div>
                                </figure>
                                <div class="product-caption text-center">
                                    <div class="product-identity">
                                        <p class="manufacturer-name"><a href="{{ route('client.pages.products.detail', $product->id) }}">{{ $product->name }}</a></p>
                                    </div>
                                    <ul class="color-categories">
                                        <li>
                                            <a class="c-lightblue" href="#" title="LightSteelblue"></a>
                                        </li>
                                        <li>
                                            <a class="c-darktan" href="#" title="Darktan"></a>
                                        </li>
                                        <li>
                                            <a class="c-grey" href="#" title="Grey"></a>
                                        </li>
                                        <li>
                                            <a class="c-brown" href="#" title="Brown"></a>
                                        </li>
                                    </ul>
                                    {{-- <h6 class="product-name">
                                        <a href="product-details.html">Perfect Diamond Jewelry</a>
                                    </h6> --}}
                                    <div class="price-box">
                                        <span class="price-regular">{{ number_format($product->price, 0, ',', '.') }}₫</span>
                                        <span class="price-old"><del>0đ</del></span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!-- product item end -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- featured product area end -->

        <!-- brand logo area start -->
        <div class="brand-logo section-padding pt-0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="brand-logo-carousel slick-row-10 slick-arrow-style">
                            <!-- single brand start -->
                            <div class="brand-item">
                                <a href="#">
                                    <img src="{{ asset('assets/client/img/brand/1.png') }}" alt="">
                                </a>
                            </div>
                            <!-- single brand end -->

                            <!-- single brand start -->
                            <div class="brand-item">
                                <a href="#">
                                    <img src="{{ asset('assets/client/img/brand/2.png') }}" alt="">
                                </a>
                            </div>
                            <!-- single brand end -->

                            <!-- single brand start -->
                            <div class="brand-item">
                                <a href="#">
                                    <img src="{{ asset('assets/client/img/brand/3.png') }}" alt="">
                                </a>
                            </div>
                            <!-- single brand end -->

                            <!-- single brand start -->
                            <div class="brand-item">
                                <a href="#">
                                    <img src="{{ asset('assets/client/img/brand/4.png') }}" alt="">
                                </a>
                            </div>
                            <!-- single brand end -->

                            <!-- single brand start -->
                            <div class="brand-item">
                                <a href="#">
                                    <img src="{{ asset('assets/client/img/brand/5.png') }}" alt="">
                                </a>
                            </div>
                            <!-- single brand end -->

                            <!-- single brand start -->
                            <div class="brand-item">
                                <a href="#">
                                    <img src="{{ asset('assets/client/img/brand/6.png') }}" alt="">
                                </a>
                            </div>
                            <!-- single brand end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- brand logo area end -->
    </section>
@endsection
@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        // Đảm bảo Echo đã load
        if (!window.Echo) {
            console.error("⚠️ Echo chưa ready!");
            return;
        }

        // Lấy user ID từ Laravel
        const userId = "{{ auth()->id() }}";

        if (!userId) {
            console.error("⚠️ Không có user đăng nhập -> bỏ lắng nghe realtime");
            return;
        }

        // Lắng nghe Private Channel
        window.Echo.private(`user.${userId}`)
            .subscribed(() => console.log(`✅ Đã join channel user.${userId}`))
            .error(err => console.error('❌ Lỗi join channel:', err))
            .listen('.order-status-updated', (data) => {
                console.log('🔔 Cập nhật đơn hàng:', data);
                alert(`📦 Đơn hàng #${data.id} đã chuyển sang trạng thái: ${data.status}`);
            });

    });
</script>
@endsection
