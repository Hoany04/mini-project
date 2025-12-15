<!doctype html>
<html class="no-js" lang="en">

<!-- Mirrored from htmldemo.net/corano/corano/index-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 29 Jun 2024 09:53:49 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Corano - Jewelry Shop eCommerce Bootstrap 5 Template</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/client/img/favicon.ico') }}">

    @yield('css')
    <!-- CSS
 ============================================ -->
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,900" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/client/css/vendor/bootstrap.min.css') }}">
    <!-- Pe-icon-7-stroke CSS -->
    <link rel="stylesheet" href="{{ asset('assets/client/css/vendor/pe-icon-7-stroke.css') }}">
    <!-- Font-awesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/client/css/vendor/font-awesome.min.css') }}">
    <!-- Slick slider css -->
    <link rel="stylesheet" href="{{ asset('assets/client/css/plugins/slick.min.css') }}">
    <!-- animate css -->
    <link rel="stylesheet" href="{{ asset('assets/client/css/plugins/animate.css') }}">
    <!-- Nice Select css -->
    <link rel="stylesheet" href="{{ asset('assets/client/css/plugins/nice-select.css') }}">
    <!-- jquery UI css -->
    <link rel="stylesheet" href="{{ asset('assets/client/css/plugins/jqueryui.min.css') }}">
    <!-- main style css -->
    <link rel="stylesheet" href="{{ asset('assets/client/css/style.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
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
        }

        .timestamp {
            display: block;
            font-size: 11px;
            margin-top: 4px;
            opacity: .7;
        }
    </style>

</head>

<body>
    <!-- Start Header Area -->
        @include('client.blocks.header')
    <!-- end Header Area -->

    <main>
        @yield('content')
    </main>

    <!-- Scroll to top start -->
    <div class="scroll-top not-visible">
        <i class="fa fa-angle-up"></i>
    </div>

    <!-- Bong bóng -->
    <div id="chat-bubble">
        💬
        <span id="chat-badge" class="badge">0</span>
    </div>

    <!-- Cửa sổ chat -->
    <div id="chat-widget">
        <div id="chat-header">
            <span>Online support</span>
            <span id="chat-close" style="cursor:pointer;">✖</span>
        </div>

        <div id="chat-body"></div>

        <div id="chat-input">
            <input type="text" id="chat-message" placeholder="Enter message...">
            <button id="chat-send">Send</button>
        </div>
    </div>
    <!-- Scroll to Top End -->

    <!-- footer area start -->
        @include('client.blocks.footer')
    <!-- footer area end -->

    <!-- Quick view modal start -->
    <div class="modal" id="quick_view">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- product details inner end -->
                    <div class="product-details-inner">
                        <div class="row">
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
                                    <p class="pro-desc">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                                        diam nonumy eirmod tempor invidunt ut labore et dolore magna.</p>
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
                                        <a class="pinterest" href="#"><i
                                                class="fa fa-pinterest"></i>save</a>
                                        <a class="google" href="#"><i
                                                class="fa fa-google-plus"></i>share</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- product details inner end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Quick view modal end -->

    <!-- JS
============================================ -->

    @vite(['resources/js/app.js'])
    <!-- Modernizer JS -->
    <script src="{{ asset('assets/client/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <!-- jQuery JS -->
    <script src="{{ asset('assets/client/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/client/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <!-- slick Slider JS -->
    <script src="{{ asset('assets/client/js/plugins/slick.min.js') }}"></script>
    <!-- Countdown JS -->
    <script src="{{ asset('assets/client/js/plugins/countdown.min.js') }}"></script>
    <!-- Nice Select JS -->
    <script src="{{ asset('assets/client/js/plugins/nice-select.min.js') }}"></script>
    <!-- jquery UI JS -->
    <script src="{{ asset('assets/client/js/plugins/jqueryui.min.js') }}"></script>
    <!-- Image zoom JS -->
    <script src="{{ asset('assets/client/js/plugins/image-zoom.min.js') }}"></script>
    <!-- Images loaded JS -->
    <script src="{{ asset('assets/client/js/plugins/imagesloaded.pkgd.min.js') }}"></script>
    <!-- mail-chimp active js -->
    <script src="{{ asset('assets/client/js/plugins/ajaxchimp.js') }}"></script>
    <!-- contact form dynamic js -->
    <script src="{{ asset('assets/client/js/plugins/ajax-mail.js') }}"></script>
    <!-- google map api -->
    <!-- Main JS -->
    <script src="{{ asset('assets/client/js/main.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    @yield('js')
    {{-- End Js --}}
    @vite(['resources/js/app.js'])

    <script>
        document.addEventListener("DOMContentLoaded", () => {

            let unreadCount = 0;
            const chatBubble = document.getElementById('chat-bubble');
            const badge = document.getElementById("chat-badge");
            const chatWidget = document.getElementById('chat-widget');
            const chatClose  = document.getElementById('chat-close');
            const chatBody   = document.getElementById('chat-body');
            const chatInput  = document.getElementById('chat-message');
            const chatSend   = document.getElementById('chat-send');

            @if(auth()->check())
            const userId = {{ auth()->id() }};
            @endif

            // Hàm format giờ: 13:02
            function formatTime() {
                const d = new Date();
                return d.getHours().toString().padStart(2,'0') + ":" +
                    d.getMinutes().toString().padStart(2,'0');
            }

            function formatServerTime(ts) {
                const d = new Date(ts);
                return d.getHours().toString().padStart(2,'0') + ":" +
                    d.getMinutes().toString().padStart(2,'0');
            }

            // Ham tang so tin chua doc
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

            // mở
            chatBubble.onclick = () => {
                chatWidget.style.display = 'flex';
                chatBubble.style.display = 'none';
                resetUnread();
                loadOldMessages();
            };

            // đóng
            chatClose.onclick = () => {
                chatWidget.style.display = 'none';
                chatBubble.style.display = 'flex';
            };

            // gửi tin nhắn
            chatSend.onclick = sendMessage;
            chatInput.addEventListener("keydown", e => {
                if (e.key === "Enter") sendMessage();
            });

            function sendMessage() {
                let msg = chatInput.value.trim();
                if (!msg) return;

                appendMessage(msg, "me");
                chatInput.value = "";

                fetch("/chat/send", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        message: msg,
                        to_id: 1
                    })
                });
            }

            function appendMessage(msg, type = "other", senderName = null, time = null) {

                time = time ?? formatTime();

                let bubble = `
                    <div style="margin-bottom:8px; width:100%; display:flex; ${type === 'me' ? 'justify-content:right' : 'justify-content:left'}">
                        <div style="
                            background:${type === 'me' ? '#4a90e2' : '#fff'};
                            color:${type === 'me' ? '#fff' : '#333'};
                            padding:8px 12px;
                            border-radius:10px;
                            max-width:75%;
                            box-shadow:0 2px 6px rgba(0,0,0,0.1)
                        ">
                            ${senderName ? `<b>${senderName}</b><br>` : ""}
                            ${msg}
                            <div class="timestamp">${time}</div>
                        </div>
                    </div>
                `;

                chatBody.insertAdjacentHTML("beforeend", bubble);
                chatBody.scrollTop = chatBody.scrollHeight;
            }

            function loadOldMessages() {
                fetch("/chat/history")
                    .then(res => res.json())
                    .then(messages => {
                        chatBody.innerHTML = "";
                        messages.forEach(m => {
                            let type = (m.from_id == userId) ? 'me' : 'other';
                            let name = type === 'other' ? (m.sender?.name ?? 'Admin') : null;
                            let time = formatServerTime(m.created_at);
                            appendMessage(m.message, type, name, time);
                        });
                    });
            }

            // REALTIME RECEIVING
            @if(auth()->check())
            window.Echo.private(`chat.${userId}`)
                .listen('.MessageSent', (e) => {

                    Notification.requestPermission().then(p => {
                        if (p === "granted") {
                            navigator.serviceWorker.ready.then(reg => {
                                reg.showNotification("You have a new message.", {
                                    body: `You have just received a new message from the Admin.`,
                                    icon: "/icons/chat.png",
                                    data: {
                                        type: "chat_user",
                                        admin_id: e.message.from_id
                                    }
                                });
                            });
                        }
                    });

                    if (e.message.from_id != userId) {

                        const widgetOpen = chatWidget.style.display === "flex";

                        if (!widgetOpen) {
                            increaseUnread();
                        }

                        appendMessage(
                            e.message.message,
                            "other",
                            e.message.sender?.name ?? "Admin"
                        );
                    }
                });
            @endif

        });
    </script>

</body>

<!-- Mirrored from htmldemo.net/corano/corano/index-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 29 Jun 2024 09:53:50 GMT -->

</html>
