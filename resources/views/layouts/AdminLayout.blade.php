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
        #chat-admin-open {
            position: fixed;
            bottom: 20px;
            top: 850px;
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
        #chat-admin-popup {
            position: fixed;
            right: 20px;
            bottom: 80px;
            width: 320px;
            height: 450px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            display: none;
            flex-direction: column;
            overflow: hidden;
            z-index: 9999;
        }
        .popup-header {
            padding: 10px 15px;
            background: #4a90e2;
            color: white;
            font-size: 17px;
            font-weight: bold;
            display:flex;
            justify-content: space-between;
            align-items:center;
        }
        .user-row {
            padding: 12px;
            display:flex;
            align-items:center;
            gap:10px;
            cursor:pointer;
            border-bottom: 1px solid #eee;
        }
        .user-row:hover {
            background:#f8f8f8;
        }
        .user-avatar {
            width:45px; height:45px;
            border-radius:50%;
            object-fit:cover;
        }
        .user-info {
            flex:1;
        }
        .user-name {
            font-weight:bold;
        }
        .user-last {
            color:#555;
            font-size:14px;
        }
        .badge-unread {
            background:red;
            color:white;
            font-size:12px;
            padding:3px 8px;
            border-radius:20px;
        }
    </style>

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
    <button id="chat-admin-open" class="btn btn-primary">
        💬
        <span id="chat-admin-unread" class="notify-dot" style="
            position:absolute;
            top:-5px;
            right:-5px;
            background:red;
            color:white;
            padding:2px 6px;
            font-size:12px;
            border-radius:12px;
            display:none;
        "></span>
    </button>

    <!-- POPUP LIST -->
    <div id="chat-admin-popup">
        <div class="popup-header">
            <span>Customer list</span>
            <span id="chat-admin-close" style="cursor:pointer;">✖</span>
        </div>

        <div id="user-list"></div>
    </div>

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

        const popup = document.getElementById("chat-admin-popup");
        const btnOpen = document.getElementById("chat-admin-open");
        const btnClose = document.getElementById("chat-admin-close");
        const userList = document.getElementById("user-list");
        const badgeTotal = document.getElementById("chat-admin-unread");

        const adminId = {{ auth()->check() ? auth()->id() : 'null' }};

        // format time
        function formatAdminTime(ts) {
            if (!ts) return "";

            let d = new Date(ts);

            if (isNaN(d.getTime())) {
                const parts = ts.split(" ");
                if (parts.length === 2) {
                    return parts[1].substring(0, 5);
                }
                return "";
            }

            return d.getHours().toString().padStart(2,'0') + ":" +
                    d.getMinutes().toString().padStart(2,'0');
        }

        // biến quản lý số lượng
        let previousUnreadTotal = 0;
        let totalUnread = 0;
        let newMessages = 0;

        // Load danh sách user từ server và cập nhật các biến
        function loadUserList() {
            return fetch("/admin/chat/users")
                .then(res => res.json())
                .then(data => {

                    userList.innerHTML = "";
                    totalUnread = 0;

                    data.forEach(u => {
                        totalUnread += Number(u.unread || 0);
                        userList.insertAdjacentHTML("beforeend", renderUserRow(u));
                    });

                    // tính số tin mới so với lần ghi nhớ trước đó
                    newMessages = totalUnread - previousUnreadTotal;
                    if (newMessages < 0) newMessages = 0;

                    updateTotalBadge();
                })
                .catch(err => {
                    console.error("Load users failed:", err);
                });
        }

        // Cập nhật hiển thị badge (chỉ hiển thị số 'mới' kể từ lần xem trước)
        function updateTotalBadge() {
            if (!badgeTotal) return;

            if (newMessages > 0) {
                badgeTotal.innerText = newMessages;
                badgeTotal.style.display = "block";
            } else {
                badgeTotal.style.display = "none";
            }
        }

        // Template user row (thêm id badge per-user để dễ update khi cần)
        function renderUserRow(u) {
            let last = u.last_message ?? "No message received.";
            let time = formatAdminTime(u.last_time);

            // mỗi badge user có id để có thể cập nhật realtime từng user nếu muốn
            return `
                <div class="user-row" onclick="openChatWith(${u.id})">
                    <img src="${u.avatar ?? '/default-avatar.png'}" class="user-avatar">

                    <div class="user-info">
                        <div class="user-name">${u.name}</div>
                        <div class="user-last">${last}</div>
                    </div>

                    <div style="text-align:right;">
                        <small style="font-size:12px; color:#888;">${time}</small><br>

                        ${u.unread > 0
                            ? `<span id="badge-user-${u.id}" class="badge-unread">${u.unread}</span>`
                            : `<span id="badge-user-${u.id}" class="badge-unread" style="display:none;">0</span>`
                        }
                    </div>
                </div>
            `;
        }

        // Mở chat với user -> gọi reset unread trên server rồi chuyển trang
        window.openChatWith = (id) => {
            fetch(`/admin/chat/reset-unread/${id}`, {
                method: "POST",
                headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" }
            })
            .then(() => {
                // sau khi reset, tải lại danh sách để cập nhật badge và tổng
                return loadUserList();
            })
            .finally(() => {
                // chuyển trang sau khi đã gọi API (không chặn nếu muốn nhanh)
                window.location.href = "/admin/chat/" + id;
            });
        };

        // Mở popup: lưu trạng thái current unread tổng là đã xem từ đây
        btnOpen && (btnOpen.onclick = () => {
            popup.style.display = "flex";

            // lưu trạng thái hiện tại như mốc "đã xem"
            previousUnreadTotal = totalUnread;
            newMessages = 0;
            updateTotalBadge();

            // tải lại danh sách để cập nhật UI user list (không reset unread DB)
            loadUserList();
        });

        btnClose && (btnClose.onclick = () => popup.style.display = "none");

        // Realtime: khi có message mới, chỉ reload list để lấy số unread mới từ DB
        if (adminId && window.Echo && typeof window.Echo.private === "function") {
            window.Echo.private("chat." + adminId)
                .listen(".MessageSent", (e) => {
                    // có thể tối ưu: nếu muốn chỉ cập nhật khi sender khác admin:
                    // if (e.message.from_id !== adminId) { ... }

                    Notification.requestPermission().then(p => {
                        if (p === "granted") {
                            navigator.serviceWorker.ready.then(reg => {
                                reg.showNotification("You have a new message.", {
                                    body: `You just received a new message from ${e.message.from_name}`,
                                    icon: "/icons/chat.png",
                                    data: {
                                        type: "chat_admin",
                                        user_id: e.message.from_id
                                    }
                                });
                            });
                        }
                    });

                    // tải lại & tính newMessages = totalUnread - previousUnreadTotal
                    loadUserList();
                });
        } else {
            // nếu không có Echo, có thể poll (tùy chọn)
            console.warn("Echo is unavailable or adminId is null. Realtime is off.");
        }

        // Load lần đầu để khởi tạo totalUnread
        loadUserList();
    });
</script>

</body>
<!-- Mirrored from demos.pixinvent.com/frest-html-admin-template/html/vertical-menu-template/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 10 Jul 2024 11:58:46 GMT -->
</html>

