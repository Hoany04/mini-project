@vite(['resources/js/app.js'])
<nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="container-xxl">

      <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0   d-xl-none ">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
          <i class="bx bx-menu bx-sm"></i>
        </a>
      </div>


      <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">


        <!-- Search -->
        <div class="navbar-nav align-items-center">
          <div class="nav-item navbar-search-wrapper mb-0">
            <a class="nav-item nav-link search-toggler px-0" href="javascript:void(0);">
              <i class="bx bx-search-alt bx-sm"></i>
              <span class="d-none d-md-inline-block">Search (Ctrl+/)</span>
            </a>
          </div>
        </div>
        <!-- /Search -->


        <ul class="navbar-nav flex-row align-items-center ms-auto">

          <!-- Language -->
          <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
              <i class='bx bx-globe bx-sm'></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="javascript:void(0);" data-language="en" data-text-direction="ltr">
                  <span class="align-middle">English</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="javascript:void(0);" data-language="fr" data-text-direction="ltr">
                  <span class="align-middle">French</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="javascript:void(0);" data-language="ar" data-text-direction="rtl">
                  <span class="align-middle">Arabic</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="javascript:void(0);" data-language="de" data-text-direction="ltr">
                  <span class="align-middle">German</span>
                </a>
              </li>
            </ul>
          </li>
          <!--/ Language -->




          <!-- Style Switcher -->
          <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
              <i class='bx bx-sm'></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
              <li>
                <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                  <span class="align-middle"><i class='bx bx-sun me-2'></i>Light</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                  <span class="align-middle"><i class="bx bx-moon me-2"></i>Dark</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                  <span class="align-middle"><i class="bx bx-desktop me-2"></i>System</span>
                </a>
              </li>
            </ul>
          </li>
          <!-- / Style Switcher-->


          <!-- Quick links  -->
          <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-2 me-xl-0">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
              <i class='bx bx-grid-alt bx-sm'></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end py-0">
              <div class="dropdown-menu-header border-bottom">
                <div class="dropdown-header d-flex align-items-center py-3">
                  <h5 class="text-body mb-0 me-auto">Shortcuts</h5>
                  <a href="javascript:void(0)" class="dropdown-shortcuts-add text-body" data-bs-toggle="tooltip" data-bs-placement="top" title="Add shortcuts"><i class="bx bx-sm bx-plus-circle"></i></a>
                </div>
              </div>
              <div class="dropdown-shortcuts-list scrollable-container">
                <div class="row row-bordered overflow-visible g-0">
                  <div class="dropdown-shortcuts-item col">
                    <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                      <i class="bx bx-calendar fs-4"></i>
                    </span>
                    <a href="app-calendar.html" class="stretched-link">Calendar</a>
                    <small class="text-muted mb-0">Appointments</small>
                  </div>
                  <div class="dropdown-shortcuts-item col">
                    <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                      <i class="bx bx-food-menu fs-4"></i>
                    </span>
                    <a href="app-invoice-list.html" class="stretched-link">Invoice App</a>
                    <small class="text-muted mb-0">Manage Accounts</small>
                  </div>
                </div>
                <div class="row row-bordered overflow-visible g-0">
                  <div class="dropdown-shortcuts-item col">
                    <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                      <i class="bx bx-user fs-4"></i>
                    </span>
                    <a href="app-user-list.html" class="stretched-link">User App</a>
                    <small class="text-muted mb-0">Manage Users</small>
                  </div>
                  <div class="dropdown-shortcuts-item col">
                    <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                      <i class="bx bx-check-shield fs-4"></i>
                    </span>
                    <a href="app-access-roles.html" class="stretched-link">Role Management</a>
                    <small class="text-muted mb-0">Permission</small>
                  </div>
                </div>
                <div class="row row-bordered overflow-visible g-0">
                  <div class="dropdown-shortcuts-item col">
                    <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                      <i class="bx bx-pie-chart-alt-2 fs-4"></i>
                    </span>
                    <a href="index.html" class="stretched-link">Dashboard</a>
                    <small class="text-muted mb-0">User Profile</small>
                  </div>
                  <div class="dropdown-shortcuts-item col">
                    <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                      <i class="bx bx-cog fs-4"></i>
                    </span>
                    <a href="pages-account-settings-account.html" class="stretched-link">Setting</a>
                    <small class="text-muted mb-0">Account Settings</small>
                  </div>
                </div>
                <div class="row row-bordered overflow-visible g-0">
                  <div class="dropdown-shortcuts-item col">
                    <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                      <i class="bx bx-help-circle fs-4"></i>
                    </span>
                    <a href="pages-faq.html" class="stretched-link">FAQs</a>
                    <small class="text-muted mb-0">FAQs & Articles</small>
                  </div>
                  <div class="dropdown-shortcuts-item col">
                    <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                      <i class="bx bx-window-open fs-4"></i>
                    </span>
                    <a href="modal-examples.html" class="stretched-link">Modals</a>
                    <small class="text-muted mb-0">Useful Popups</small>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <!-- Quick links -->

          <!-- Notification -->
          <li class="nav-item dropdown">
                <button class="btn btn-light position-relative" id="admin-noti-btn" data-bs-toggle="dropdown">
                    🔔
                    <span id="admin-noti-count" class="badge bg-danger">
                        {{ auth()->user()->unreadNotifications->count() }}
                    </span>
                </button>

                <ul class="dropdown-menu dropdown-menu-end"
                    id="admin-noti-list"
                    style="width:300px; max-height:400px; overflow-y:auto;">

                    @forelse(auth()->user()->notifications as $notify)
                        <li class="dropdown-item {{ $notify->read_at ? 'noti-read' : 'noti-unread' }}">
                            🛒 {{ $notify->data['message'] }}
                            <br>
                            <small class="text-muted">{{ $notify->created_at->diffForHumans() }}</small>
                        </li>
                    @empty
                        <li class="dropdown-item text-muted">Không có thông báo</li>
                    @endforelse
                </ul>
            </li>

          <!--/ Notification -->

          <!-- User -->
          <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
              <div class="avatar avatar-online">
                <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="rounded-circle">
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="pages-account-settings-account.html">
                  <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                      <div class="avatar avatar-online">
                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="rounded-circle">
                      </div>
                    </div>
                    <div class="flex-grow-1">
                      <span class="fw-medium d-block lh-1">John Doe</span>
                      <small>Admin</small>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <a class="dropdown-item" href="pages-profile-user.html">
                  <i class="bx bx-user me-2"></i>
                  <span class="align-middle">My Profile</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="pages-account-settings-account.html">
                  <i class="bx bx-cog me-2"></i>
                  <span class="align-middle">Settings</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="pages-account-settings-billing.html">
                  <span class="d-flex align-items-center align-middle">
                    <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                    <span class="flex-grow-1 align-middle">Billing</span>
                    <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                  </span>
                </a>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <a class="dropdown-item" href="pages-faq.html">
                  <i class="bx bx-help-circle me-2"></i>
                  <span class="align-middle">FAQ</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="pages-pricing.html">
                  <i class="bx bx-dollar me-2"></i>
                  <span class="align-middle">Pricing</span>
                </a>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              {{-- {{ Auth::user()->name }} --}}
              <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit">Logout</button>
              </form>
            </ul>
          </li>
          <!--/ User -->


        </ul>
      </div>


      <!-- Search Small Screens -->
      <div class="navbar-search-wrapper search-input-wrapper container-xxl d-none">
        <input type="text" class="form-control search-input border-0" placeholder="Search..." aria-label="Search...">
        <i class="bx bx-x bx-sm search-toggler cursor-pointer"></i>
      </div>


    </div>
  </nav>
@section('js')

@if(auth()->check())
<script>
    window.LaravelUserId = {{ auth()->id() }};
</script>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endif

<script>
document.addEventListener('DOMContentLoaded', () => {

    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/sw.js')
            .then(() => console.log("Service Worker registered"))
            .catch(err => console.error("SW failed:", err));
    }
    console.log("📡 Admin Notification JS Loaded");

    //    JOIN CHANNEL: admin.notifications

    const channelName = 'admin.notifications';
    console.log("📺 Subscribing to channel:", channelName);

    const channel = window.Echo.private(channelName);

    //    LẮNG NGHE REALTIME
    //     Event = .NewOrderNotification

    channel.listen('.NewOrderNotification', (data) => {
            console.log("🔔 Nhận realtime:", data);

        const orderId    = data.order_id;
        const userName   = data.user_name || "Khách hàng";
        const total      = data.total || 0;
        const message    = data.message || `Đơn hàng #${orderId} mới`;

        Notification.requestPermission().then(permission => {
            if (permission === 'granted') {
                navigator.serviceWorker.ready.then(reg => {
                    reg.showNotification(message, {
                        body: `Tổng tiền: ${total}₫`,
                        icon: '/icons/order.png',
                        data: {
                            order_id: orderId,
                            type: "admin"
                        }
                    });
                });
            }

        });

        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'info',
            title: message,
            text: `Tổng tiền: ${total}₫`,
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });

        /**
         Badge tăng số lượng
         */
        const badge = document.querySelector("#admin-noti-count");
        badge.innerText = (parseInt(badge.innerText) || 0) + 1;

        /**
          Thêm vào list noti
         */
        const list = document.querySelector("#admin-noti-list");
        list.insertAdjacentHTML('afterbegin', `
            <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-new">
                <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                        <div class="avatar">
                            <img src="/assets/img/avatars/1.png" class="w-px-40 h-auto rounded-circle">
                        </div>
                    </div>

                    <div class="flex-grow-1">
                        <h6 class="mb-1">Đơn hàng mới #${orderId}</h6>
                        <p class="mb-0">Khách: ${userName}</p>
                        <small class="text-muted">${new Date().toLocaleString()}</small>
                    </div>

                    <div class="flex-shrink-0 dropdown-notifications-actions">
                        <span class="badge badge-dot"></span>
                    </div>
                </div>
            </li>
        `);
    });

    /**
     * Khi mở dropdown → mark as read
     */
    const dropdownBtn = document.getElementById("admin-noti-btn");

    if (dropdownBtn) {
        dropdownBtn.addEventListener("click", () => {

            fetch("/admin/notifications/mark-as-read", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": window.csrfToken || document.querySelector('meta[name="csrf-token"]').content,
                    "Accept": "application/json"
                }
            }).then(() => {
                console.log("✔ Admin notifications marked-as-read");

                // Reset badge
                const badge = document.getElementById("admin-noti-count");
                badge.innerText = 0;

                // Remove highlight
                document.querySelectorAll("#admin-noti-list .marked-as-new")
                    .forEach((item) => item.classList.remove("marked-as-new"));
            });
        });
    }

    /**
     * Debug kết nối pusher
     */
    if (window.Echo && window.Echo.connector && window.Echo.connector.pusher) {
        window.Echo.connector.pusher.connection.bind('connected', () => {
            console.log("✅ Pusher connected successfully");
        });
    }
});
</script>

@endsection

