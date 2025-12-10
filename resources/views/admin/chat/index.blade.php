@extends('layouts.AdminLayout')
@section('content')
<style>
    .chat-messages {
        height: 420px;
        overflow-y: auto;
        padding: 15px;
        background: #f5f5f5;
        border-radius: 10px;
    }

    .chat-row {
        display: flex;
        margin-bottom: 12px;
        align-items: flex-end;
        width: 100%;
    }

    /* Tin nhắn của mình */
    .chat-row.me {
        justify-content: flex-end;
    }

    /* Tin nhắn của người khác */
    .chat-row.other {
        justify-content: flex-start;
    }

    /* Avatar */
    .chat-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        margin-right: 8px;
    }

    /* Bong bóng tin nhắn */
    .chat-bubble {
        max-width: 70%;
        padding: 10px 14px;
        border-radius: 18px;
        font-size: 14px;
        line-height: 1.4;
        box-shadow: 0 1px 3px rgba(0,0,0,0.15);
        word-break: break-word;
    }

    /* Bong bóng của mình */
    .chat-row.me .chat-bubble {
        background: #0084ff;
        color: #fff;
        border-bottom-right-radius: 6px;
    }

    /* Bong bóng của người khác */
    .chat-row.other .chat-bubble {
        background: #ffffff;
        color: #333;
        border-bottom-left-radius: 6px;
    }

    /* Khung nhập tin nhắn */
    .chat-input-wrapper {
        display: flex;
        margin-top: 12px;
        gap: 10px;
    }

    .chat-input {
        flex: 1;
        border-radius: 25px;
        padding-left: 15px;
    }

    .chat-btn {
        border-radius: 25px;
        padding: 0 22px;
    }

    /* Header */
    .chat-header {
        background: #fff;
        border-bottom: 1px solid #eee;
    }

    .online-dot {
        color: #4caf50;
        font-weight: bold;
    }

    /* Typing indicator */
    .typing-indicator {
        display: none;
        font-size: 13px;
        color: #777;
        margin: 6px 0 10px 4px;
        font-style: italic;
    }
</style>


<div class="chat-header d-flex align-items-center p-2">
    @if($userInfo->profile && $userInfo->profile->avatar)
        <img src="{{ asset('storage/' . $userInfo->profile->avatar) }}"
             class="rounded-circle me-2" width="40" height="40">
    @else
        <img src="/default-avatar.png"
             class="rounded-circle me-2" width="40" height="40">
    @endif

    <div style="line-height: 1;">
        <strong>{{ $userInfo->username }}</strong><br>
        <small class="online-dot">● {{ $userInfo->status }}</small>
    </div>
</div>

<div id="chat-box"
     data-admin_id="{{ auth()->id() }}"
     data-user_id="{{ $userId }}">

    <div id="chat-messages" class="chat-messages">
        @foreach($messages as $msg)

        @php
            $avatar = $msg->sender->profile->avatar ?? null;
            $avatarUrl = $avatar ? asset('storage/' . $avatar) : asset('default-avatar.png');
        @endphp

        <div class="chat-row {{ $msg->from_id == auth()->id() ? 'me' : 'other' }}">

            @if($msg->from_id != auth()->id())
                <img class="chat-avatar" src="{{ $avatarUrl }}" alt="Avatar">
            @endif

            <div class="chat-bubble">
                {{ $msg->message }}
            </div>
        </div>

        @endforeach
        <div id="typing-indicator" class="typing-indicator">
        User is typing…
    </div>
    </div>

    <div class="chat-input-wrapper">
        <input id="chat-input" class="form-control chat-input" placeholder="Nhập tin nhắn...">
        <button id="chat-send" class="btn btn-primary chat-btn">Send</button>
    </div>
</div>


@endsection
@push('script')
  <script>
    document.addEventListener("DOMContentLoaded", () => {

        const box = document.getElementById("chat-box");
        const adminId = box.dataset.admin_id;
        const userId  = box.dataset.user_id;

        const input = document.getElementById("chat-input");
        const sendBtn = document.getElementById("chat-send");
        const messages = document.getElementById("chat-messages");
        const typingBox = document.getElementById('typing-indicator');

        let typingTimeout;

        // format gio
        function formatTime() {
            const d = new Date();
            return d.getHours().toString().padStart(2, "0") + ":" +
                   d.getMinutes().toString().padStart(2, "0");
        }

        // Gửi tin nhắn
        sendBtn.addEventListener("click", sendMessage);
        input.addEventListener("keypress", e => {
            if (e.key === "Enter") sendMessage();
        });

        // Bat typing khi admin dang nhap
        input.addEventListener("input", () => {
            window.Echo.private("chat." + userId)
                .whisper("typing", { typing: true, from: adminId });

            clearTimeout(typingTimeout);
            typingTimeout = setTimeout(() => {
                window.Echo.private("chat." + userId)
                    .whisper("typing", { typing: false, from: adminId });
            }, 1200);
        });

        function sendMessage() {
            let text = input.value.trim();
            if (text === "") return;

            fetch("{{ route('admin.chat.send') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                },
                body: JSON.stringify({
                    message: text,
                    user_id: userId
                })
            })
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    appendMyMessage(text);
                    input.value = "";
                }
            });

            window.Echo.private("chat." + adminId)
                .whisper("typing", { typing: false });
        }

        // Hiển thị tin nhắn của admin
        function appendMyMessage(text) {

            let time = formatTime();

            let html = `
                <div class="chat-row me">
                    <div class="chat-bubble">
                        ${text}
                        <div style="font-size:11px; text-align:right; margin-top:4px; opacity:0.7;">
                            ${time}
                        </div>
                    </div>
                </div>
            `;

            messages.insertAdjacentHTML("beforeend", html);
            messages.scrollTop = messages.scrollHeight;
        }

        // Nhận realtime từ user → admin
        const channel = window.Echo.private("chat." + adminId);
        channel.listen(".MessageSent", (e) => {

            if (e.message.from_id == userId) {

                let time = formatTime();

                messages.insertAdjacentHTML("beforeend", `
                    <div class="chat-row other">
                        <img class="chat-avatar" src="${e.avatar}" alt="Avatar">
                        <div class="chat-bubble">
                            ${e.message.message}
                            <div style="font-size:11px; margin-top:4px; opacity:0.7;">
                                ${time}
                            </div>
                        </div>
                    </div>
                `);

                typingBox.style.display = "none";
                messages.scrollTop = messages.scrollHeight;
            }
        });

        channel.listenForWhisper("typing", (e) => {
            if (e.typing) {
                typingBox.style.display = "block";
            } else {
                typingBox.style.display = "none";
            }
        });
    });
    </script>

@endpush
