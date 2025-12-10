<!doctype html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr" data-theme="theme-default" data-assets-path="/assets/" data-template="vertical-menu-template">

<!-- Mirrored from demos.pixinvent.com/frest-html-admin-template/html/vertical-menu-template/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 10 Jul 2024 11:57:54 GMT -->
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard - Analytics | Frest - Bootstrap Admin Template</title>

    <meta name="description" content="Start your development with a Dashboard for Bootstrap 5" />
    <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
    <!-- Canonical SEO -->
    <link rel="canonical" href="https://1.envato.market/frest_admin">
    {{-- @vite(['resources/js/app.js', 'resources/css/app.css']) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    @vite(['resources/js/app.js'])

    <style>
    /* Bong bóng chat */
        #chat-bubble {
            position: fixed;
            bottom: 20px;
            top: 750px;
            right: 18px;
            width: 54px;
            height: 54px;
            background: #4a90e2;
            color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            z-index: 99999;
        }

        #chat-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: red;
            color: white;
            font-size: 12px;
            padding: 2px 6px;
            border-radius: 50%;
            display: none;
        }

        /* Cửa sổ chat */
        #chat-widget {
            position: fixed;
            bottom: 90px;
            right: 20px;
            width: 320px;
            height: 420px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            overflow: hidden;
            display: none; /* Ẩn ban đầu */
            flex-direction: column;
            font-family: sans-serif;
            z-index: 99999;
            animation: fadeIn 0.25s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        #chat-header {
            background: #4a90e2;
            color: white;
            padding: 12px;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
        }

        #chat-body {
            flex: 1;
            padding: 10px;
            overflow-y: auto;
            background: #f7f7f7;
        }
/*
        #chat-input {
            padding: 10px;
            display: flex;
            background: white;
        }

        #chat-input input {
            flex: 1;
            padding: 8px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        #chat-input button {
            margin-left: 8px;
            padding: 8px 12px;
            border: none;
            background: #4a90e2;
            color: white;
            border-radius: 8px;
        } */

        .timestamp {
            display: block;
            font-size: 11px;
            margin-top: 4px;
            opacity: .7;
        }
    </style>

    <!-- ? PROD Only: Google Tag Manager (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
    {{-- <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                '../../../../www.googletagmanager.com/gtm5445.html?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-5J3LMKC');
    </script> --}}
    <!-- End Google Tag Manager -->

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="https://demos.pixinvent.com/frest-html-admin-template/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

</head>

<body>

  <!-- ?PROD Only: Google Tag Manager (noscript) (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
  <noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5DDHKGP" height="0" width="0" style="display: none; visibility: hidden">
    </iframe>
</noscript>
  <!-- End Google Tag Manager (noscript) -->

  <!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar  ">
  <div class="layout-container">
<!-- Menu -->
    @include('layouts.blocks.aside')
<!-- / Menu -->

    <!-- Layout container -->
    <div class="layout-page">

<!-- Navbar -->

  @include('layouts.blocks.header')

<!-- / Navbar -->

      <!-- Content wrapper -->
      <div class="content-wrapper">

        <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                @yield('content')
            </div>
        </div>
          <!-- / Content -->

<!-- Footer -->
    @include('layouts.blocks.footer')
<!-- / Footer -->

          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>

  </div>

  {{-- popup chat --}}
     <!-- Bong bóng -->
    <div id="chat-bubble">
        💬
        <span id="chat-badge" class="badge">0</span>
    </div>

    <!-- Cửa sổ chat -->
    <div id="chat-widget">
        <div id="chat-header">
            <span>Hỗ trợ trực tuyến</span>
            <span id="chat-close" style="cursor:pointer;">✖</span>
        </div>

        <div id="chat-body"></div>

        {{-- <div id="chat-input">
            <input type="text" id="chat-message" placeholder="Nhập tin nhắn...">
            <button id="chat-send">Gửi</button>
        </div> --}}
    </div>
  <!-- / Layout wrapper -->

  {{-- <div class="buy-now">
    <a href="https://1.envato.market/frest_admin" target="_blank" class="btn btn-danger btn-buy-now">Buy Now</a>
  </div> --}}

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  @stack('script')
  <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
  <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>
  <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

  <!-- Main JS -->
  <script src="{{ asset('assets/js/main.js') }}"></script>


  <!-- Page JS -->
  <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @yield('js')
  <script>
    document.addEventListener("DOMContentLoaded", () => {

        let unreadCount = 0;
        const chatBubble = document.getElementById('chat-bubble');
        const badge = document.getElementById("chat-badge");
        const chatWidget = document.getElementById('chat-widget');
        const chatClose  = document.getElementById('chat-close');
        const chatBody   = document.getElementById('chat-body');

        @if(auth()->check())
        const userId = {{ auth()->id() }};
        @endif

        // Hàm tăng số tin chưa đọc
        function increaseUnread() {
            unreadCount++;
            badge.innerText = unreadCount;
            badge.style.display = "inline-block";
        }

        function resetUnread() {
            unreadCount = 0;
            badge.innerText = "0";
            badge.style.display = "none";
        }

        // 👉 Lấy danh sách user đã nhắn tin
        function loadUserList() {
            fetch("/admin/chat/users")
                .then(res => res.json())
                .then(list => {
                    chatBody.innerHTML = "";

                    if (list.length === 0) {
                        chatBody.innerHTML = "<p style='padding:10px; color:#777;'>Chưa có tin nhắn nào.</p>";
                        return;
                    }

                    list.forEach(u => {
                        chatBody.insertAdjacentHTML("beforeend", `
                            <div class="chat-user-item"
                                style="padding:10px; border-bottom:1px solid #eee; cursor:pointer;"
                                data-id="${u.id}">

                                <b>${u.name}</b><br>
                                <small>${u.last_message ?? "..."}</small><br>
                                <small style="color:#777;">${formatTime(u.last_time)}</small>
                            </div>
                        `);
                    });

                    attachUserClickEvents();
                });
        }

        // 👉 Khi click vào 1 user → mở cuộc trò chuyện
        function attachUserClickEvents() {
            document.querySelectorAll(".chat-user-item").forEach(item => {
                item.addEventListener("click", () => {
                    const uid = item.dataset.id;
                    loadChatWith(uid);
                });
            });
        }

        // 👉 Hàm mở cửa sổ chat với user
        function loadChatWith(userId) {
            // Hiển thị giao diện chat
            chatWidget.style.display = "flex";
            chatBubble.style.display = "none";

            // Reset badge
            resetUnread();

            // Gọi API để lấy lịch sử chat
            fetch(`/admin/chat/${userId}`)
                .then(res => {
                    if (res.redirected) {
                        window.location.href = res.url;
                        return;
                    }
                    return res.text();
                })
                .then(html => {
                    // Thay nội dung cửa sổ chat bằng giao diện chat admin
                    chatWidget.innerHTML = html;
                })
                .catch(err => console.error("Load chat failed:", err));
        }


        function formatTime(timeStr) {
            const d = new Date(timeStr);
            return d.getHours().toString().padStart(2,"0") + ":" +
                d.getMinutes().toString().padStart(2,"0");
        }

        // 👉 Nhấn bong bóng → mở widget + load danh sách user
        chatBubble.onclick = () => {
            chatWidget.style.display = 'flex';
            chatBubble.style.display = 'none';
            resetUnread();

            loadUserList();
        };

        chatClose.onclick = () => {
            chatWidget.style.display = 'none';
            chatBubble.style.display = 'flex';
        };

    });
</script>

</body>


<!-- Mirrored from demos.pixinvent.com/frest-html-admin-template/html/vertical-menu-template/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 10 Jul 2024 11:58:46 GMT -->
</html>

<!-- beautify ignore:end -->
