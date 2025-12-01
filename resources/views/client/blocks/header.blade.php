@vite(['resources/js/app.js'])
<header class="header-area header-wide bg-gray">
    <!-- main header start -->
    <div class="main-header d-none d-lg-block">
        <!-- header top start -->
        <div class="header-top bdr-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="welcome-message">
                            <p>Welcome to Corano Jewelry online store</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header top end -->

        <!-- header middle area start -->
        <div class="header-main-area sticky">
            <div class="container">
                <div class="row align-items-center position-relative">

                    <!-- start logo area -->
                    <div class="col-lg-2">
                        <div class="logo">
                            <a href="index-2.html">
                                <img src="{{ asset('assets/client/img/logo/logo.png') }}" alt="brand logo">
                            </a>
                        </div>
                    </div>
                    <!-- start logo area -->

                    <!-- main menu area start -->
                    <div class="col-lg-6 position-static">
                        <div class="main-menu-area">
                            <div class="main-menu">
                                <!-- main menu navbar start -->
                                <nav class="desktop-menu">
                                    <ul>
                                        <li class="active"><a href="{{ route('client.home') }}">Home <i
                                                    class="fa fa-angle-down"></i></a>
                                        </li>
                                        <li class="position-static"><a href="#">pages <i
                                                    class="fa fa-angle-down"></i></a>
                                            <ul class="megamenu dropdown">

                                                <li class="megamenu-banners d-none d-lg-block">
                                                    <a href="product-details.html">
                                                        <img src="{{ asset('assets/client/img/banner/img1-static-menu.jpg') }}"
                                                            alt="">
                                                    </a>
                                                </li>
                                                <li class="megamenu-banners d-none d-lg-block">
                                                    <a href="product-details.html">
                                                        <img src="{{ asset('assets/client/img/banner/img2-static-menu.jpg') }}"
                                                            alt="">
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="{{ route('client.pages.products.index') }}">shop <i class="fa fa-angle-down"></i></a>

                                        </li>
                                        <li><a href="blog-left-sidebar.html">Blog <i
                                                    class="fa fa-angle-down"></i></a>
                                        </li>
                                        <li><a href="contact-us.html">Contact us</a></li>
                                    </ul>
                                </nav>
                                <!-- main menu navbar end -->
                            </div>
                        </div>
                    </div>
                    <!-- main menu area end -->

                    <!-- mini cart area start -->
                    <div class="col-lg-4">
                        <div
                            class="header-right d-flex align-items-center justify-content-xl-between justify-content-lg-end">
                            <div class="header-search-container">
                                <button class="search-trigger d-xl-none d-lg-block"><i
                                        class="pe-7s-search"></i></button>
                                <form class="header-search-box d-lg-none d-xl-block">
                                    <input type="text" placeholder="Search entire store hire"
                                        class="header-search-field bg-white">
                                    <button class="header-search-btn"><i class="pe-7s-search"></i></button>
                                </form>
                            </div>
                            <div class="nav-item dropdown">
                                <button id="notification-btn" class="btn btn-light position-relative" data-bs-toggle="dropdown">
                                    🔔
                                    @if(auth()->check())
                                        <span id="notification-count" class="badge bg-danger">
                                            {{ auth()->user()->unreadNotifications->count() }}
                                        </span>
                                    @else
                                        <span id="notification-count" class="badge bg-secondary">0</span>
                                    @endif

                                </button>

                                <ul class="dropdown-menu dropdown-menu-end" style="width: 300px; max-height: 400px; overflow-y: auto;" id="notification-list">
                                    @if(auth()->check())
                                        @forelse(auth()->user()->notifications as $notify)
                                            <li class="dropdown-item">📦 {{ $notify->data['message'] }}
                                                <br>
                                                <small class="text-muted">{{ $notify->created_at->diffForHumans() }}</small>
                                            </li>
                                        @empty
                                            <li class="dropdown-item text-muted">Không có thông báo</li>
                                        @endforelse
                                    @else
                                        <li class="dropdown-item text-muted">Đăng nhập để xem thông báo</li>
                                    @endif
                                </ul>


                                {{-- <button id="mark-read-btn" class="btn btn-sm btn-link text-primary d-block ms-2 mt-1">
                                    ✔ Đánh dấu đã đọc
                                </button> --}}

                            </div>
                            <div class="header-configure-area">
                                <ul class="nav justify-content-end">
                                    <li class="user-hover">
                                        <a href="#">
                                            <i class="pe-7s-user"></i>
                                        </a>
                                        <ul class="dropdown-list">
                                            <form action="{{ route('logout') }}" method="post">
                                                @csrf
                                                <button type="submit">Logout</button>
                                              </form>
                                            <li><a href="{{ route('client.pages.account.index') }}">my account</a></li>
                                        </ul>
                                    </li>
                                    {{-- <li>
                                        <a href="wishlist.html">
                                            <i class="pe-7s-like"></i>
                                            <div class="notification">0</div>
                                        </a>
                                    </li> --}}
                                    <li>
                                        <a href="{{ route('client.pages.cart.index') }}" class="minicart-btn">
                                            <i class="pe-7s-shopbag"></i>
                                            <div class="notification">{{ session('cart') ? count(session('cart')) : '0'}}</div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- mini cart area end -->

                </div>
            </div>
        </div>
        <!-- header middle area end -->
    </div>
    <!-- main header start -->

    <!-- mobile header start -->
    <!-- mobile header start -->
    <div class="mobile-header d-lg-none d-md-block sticky">
        <!--mobile header top start -->
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="mobile-main-header">
                        <div class="mobile-logo">
                            <a href="index.html">
                                <img src="{{ asset('assets/client/img/logo/logo.png') }}" alt="Brand Logo">
                            </a>
                        </div>
                        <div class="mobile-menu-toggler">
                            <div class="mini-cart-wrap">
                                <a href="{{ route('client.pages.cart.index') }}">
                                    <i class="pe-7s-shopbag"></i>
                                    <div class="notification">0</div>
                                </a>
                            </div>
                            <button class="mobile-menu-btn">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- mobile header top start -->
    </div>
    <!-- mobile header end -->
    <!-- mobile header end -->

    <!-- offcanvas mobile menu start -->
    <!-- off-canvas menu start -->
    <aside class="off-canvas-wrapper">
        <div class="off-canvas-overlay"></div>
        <div class="off-canvas-inner-content">
            <div class="btn-close-off-canvas">
                <i class="pe-7s-close"></i>
            </div>

            <div class="off-canvas-inner">
                <!-- search box start -->
                <div class="search-box-offcanvas">
                    <form>
                        <input type="text" placeholder="Search Here...">
                        <button class="search-btn"><i class="pe-7s-search"></i></button>
                    </form>
                </div>
                <!-- search box end -->

                <!-- offcanvas widget area start -->
                <div class="offcanvas-widget-area">
                    <div class="off-canvas-contact-widget">
                        <ul>
                            <li><i class="fa fa-mobile"></i>
                                <a href="#">0123456789</a>
                            </li>
                            <li><i class="fa fa-envelope-o"></i>
                                <a href="#">info@yourdomain.com</a>
                            </li>
                        </ul>
                    </div>
                    <div class="off-canvas-social-widget">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-pinterest-p"></i></a>
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                        <a href="#"><i class="fa fa-youtube-play"></i></a>
                    </div>
                </div>
                <!-- offcanvas widget area end -->
            </div>
        </div>
    </aside>
    <!-- off-canvas menu end -->
    <!-- offcanvas mobile menu end -->
</header>
@section('js')
<script>
document.addEventListener('DOMContentLoaded', () => {

    @if(auth()->check())
    const userId = {{ auth()->id() }};
    console.log("📡 Listening to: user." + userId);

    const channel = window.Echo.private(`user.${userId}`);

    // Lắng nghe notification Laravel
    channel.notification((notification) => {

        console.log("🔔 Notification mới:", notification);

        // Tăng badge
        const badge = document.querySelector("#notification-count");
        badge.innerText = parseInt(badge.innerText || 0) + 1;

        // Thêm vào danh sách
        const list = document.querySelector("#notification-list");
        list.innerHTML = `
            <li class="dropdown-item">
                📦 ${notification.message} <br>
                <small class="text-muted">${new Date().toLocaleTimeString()}</small>
            </li>
        ` + list.innerHTML;
    });

    // Bắt event raw nếu cần debug (không bắt bắt buộc)
    channel.listen('.Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', (e) => {
        console.log("📡 Raw event:", e);
    });

    // Kiểm tra kết nối
    window.Echo.connector.pusher.connection.bind('connected', () => {
        console.log("✅ Echo đã kết nối Pusher thành công");
    });

    @endif
});
</script>
@endsection

