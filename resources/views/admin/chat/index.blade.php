@extends('layouts.AdminLayout')
@section('content')

<style>
        /* KHUNG TIN NHẮN */
    .chat-messages {
        height: 420px;
        overflow-y: auto;
        padding: 15px;
        background: #f5f5f5;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
    }

        /* DÒNG TIN NHẮN */
    .chat-row {
        display: flex;
        align-items: flex-end;
        width: 100%;
        margin-bottom: 10px;
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
        flex-shrink: 0;
        border-radius: 50%;
        margin-right: 8px;
    }

    /* Bubble */
    .chat-bubble {
        max-width: 70%;
        padding: 10px 14px;
        border-radius: 18px;
        font-size: 14px;
        line-height: 1.4;
        background: #fff;
        color: #333;
        box-shadow: 0 1px 3px rgba(0,0,0,0.15);
        word-break: break-word;
    }

    /* My bubble */
    .chat-row.me .chat-bubble {
        background: #0084ff;
        color: #fff;
        margin-left: 8px;
        border-bottom-right-radius: 6px;
    }

    /* Their bubble */
    .chat-row.other .chat-bubble {
        background: #ffffff;
        border-bottom-left-radius: 6px;
    }

        /* INPUT */
    .chat-input-wrapper {
        display: flex;
        gap: 10px;
        margin-top: 12px;
    }

    .chat-input {
        flex: 1;
        padding-left: 15px;
        border-radius: 25px;
    }

    .chat-btn {
        border-radius: 25px;
        padding: 0 22px;
    }

        /* HEADER */
    .chat-header {
        background: #fff;
        border-bottom: 1px solid #eee;
    }

    .online-dot {
        color: #4caf50;
        font-weight: bold;
    }

        /* TYPING */
    .typing-indicator {
        display: none;
        font-size: 13px;
        font-style: italic;
        color: #777;
        margin: 6px 0 10px 4px;
    }
</style>

<div class="chat-header d-flex align-items-center p-2">
    @if($userInfo->profile && $userInfo->profile->avatar)
        <img src="{{ asset('storage/'.$userInfo->profile->avatar) }}" class="rounded-circle me-2" width="40" height="40">
    @else
        <img src="/default-avatar.png" class="rounded-circle me-2" width="40" height="40">
    @endif

    <div style="line-height:1;">
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
                $avatarUrl = $avatar ? asset('storage/'.$avatar) : asset('default-avatar.png');
            @endphp

            <div class="chat-row {{ $msg->from_id == auth()->id() ? 'me' : 'other' }}">

                @if($msg->from_id != auth()->id())
                    <img class="chat-avatar" src="{{ $avatarUrl }}">
                @endif

                <div class="chat-bubble">
                    {{ $msg->message }}
                    <div style="font-size:11px;margin-top:4px;opacity:.7;">
                        {{ $msg->created_at->format('H:i') }}
                    </div>
                </div>
            </div>
        @endforeach

        <div id="typing-indicator" class="typing-indicator">User is typing…</div>
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

        function formatServerTime(ts) {
            if (!ts) return "";

            let d = new Date(ts);

            if (isNaN(d.getTime())) return "";

            return d.getHours().toString().padStart(2,'0') + ":" +
                    d.getMinutes().toString().padStart(2,'0');
        }

        // SEND MESSAGE
        sendBtn.addEventListener("click", sendMessage);
        input.addEventListener("keypress", e => {
            if (e.key === "Enter") sendMessage();
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
                    to_id: userId,
                })
            })
            .then(res => res.json())
            .then(res => {
                if (res.message) {
                    appendMyMessage(text, res.message.created_at);
                    input.value = "";
                }
            });

            window.Echo.private("chat."+adminId)
                .whisper("typing", { typing:false });
        }

        // UI: Append tin nhắn admin
        function appendMyMessage(text, created_at) {
            let time = formatServerTime(created_at);

            let html = `
                <div class="chat-row me">
                    <div class="chat-bubble">
                        ${text}
                        <div style="font-size:11px;text-align:right;margin-top:4px;opacity:.7;">
                            ${time}
                        </div>
                    </div>
                </div>
            `;

            messages.insertAdjacentHTML("beforeend", html);
            messages.scrollTop = messages.scrollHeight;
        }

        // REALTIME: Nhận từ user
        const channel = window.Echo.private("chat."+adminId);

        channel.listen(".MessageSent", (e) => {

            if (e.message.from_id == userId) {

                let time = formatServerTime(e.message.created_at);

                messages.insertAdjacentHTML("beforeend", `
                    <div class="chat-row other">
                        <img class="chat-avatar" src="${e.message.avatar}">
                        <div class="chat-bubble">
                            ${e.message.message}
                            <div style="font-size:11px;margin-top:4px;opacity:.7;">
                                ${time}
                            </div>
                        </div>
                    </div>
                `);

                typingBox.style.display = "none";
                messages.scrollTop = messages.scrollHeight;
            }
        });

        // REALTIME TYPING
        input.addEventListener("input", () => {

            window.Echo.private("chat."+userId)
                .whisper("typing", { typing:true });

            clearTimeout(typingTimeout);
            typingTimeout = setTimeout(() => {
                window.Echo.private("chat."+userId)
                    .whisper("typing", { typing:false });
            }, 1200);
        });

        channel.listenForWhisper("typing", (e) => {
            typingBox.style.display = e.typing ? "block" : "none";
        });

    });
</script>
@endpush
