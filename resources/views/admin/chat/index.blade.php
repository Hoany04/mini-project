@extends('layouts.AdminLayout')
@section('content')
<style>
    .chat-messages {
        height: 420px;
        overflow-y: auto;
        padding: 15px;
        background: #e5ddd5;
        border-radius: 10px;
    }

    .chat-row {
        display: flex;
        margin-bottom: 10px;
        align-items: flex-end;
    }

    .chat-row.me {
        justify-content: flex-end;
    }

    .chat-row.other {
        justify-content: flex-start;
    }

    .chat-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        margin-right: 6px;
    }

    .chat-bubble {
        max-width: 70%;
        padding: 10px 14px;
        border-radius: 18px;
        font-size: 14px;
        line-height: 1.4;
        box-shadow: 0 1px 4px rgba(0,0,0,0.2);
    }

    .chat-row.me .chat-bubble {
        background: #0084ff;
        color: #fff;
        border-bottom-right-radius: 4px;
    }

    .chat-row.other .chat-bubble {
        background: #fff;
        color: #333;
        border-bottom-left-radius: 4px;
    }

    .chat-input-wrapper {
        display: flex;
        margin-top: 12px;
    }

    .chat-input {
        flex: 1;
        border-radius: 20px;
        padding-left: 15px;
    }

    .chat-btn {
        border-radius: 20px;
        padding: 0 20px;
        margin-left: 10px;
    }
</style>

<div class="chat-header d-flex align-items-center p-2 border-bottom" style="background:#fff;">
    @if($userInfo->profile && $userInfo->profile->avatar)
        <img src="{{ asset('storage/' . $userInfo->profile->avatar) }}"
             class="rounded-circle me-2" width="40" height="40">
    @else
        <img src="/default-avatar.png"
             class="rounded-circle me-2" width="40" height="40">
    @endif

    <div style="line-height: 1;">
        <strong>{{ $userInfo->username }}</strong><br>
        <small style="color: {{ $userInfo->status === 'online' ? 'green' : 'green' }};">
            ● {{ $userInfo->status === 'online' ? 'Active' : 'Active' }}
        </small>
    </div>

</div>

<div id="chat-box"
     data-admin_id="{{ auth()->id() }}"
     data-user_id="{{ $userId }}">

    <!-- KHUNG TIN NHẮN -->
    <div id="chat-messages" class="chat-messages">
        @foreach($messages as $msg)
            <div class="chat-row {{ $msg->from_id == auth()->id() ? 'me' : 'other' }}">

                @php
                    $avatar = $msg->sender->profile->avatar ?? null;
                    $avatarUrl = $avatar ? asset('storage/' . $avatar) : asset('default-avatar.png');
                @endphp

                {{-- <img class="chat-avatar" src="{{ $avatarUrl }}" alt="Avatar"> --}}

                <div class="chat-bubble">
                    {{ $msg->message }}
                </div>
            </div>
        @endforeach
    </div>

    <!-- INPUT -->
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

        // Gửi tin nhắn
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
        }

        // Hiển thị tin nhắn của admin
        function appendMyMessage(text, type = "other", avatar = null) {
            let html = `
                <div class="chat-row ${type}">
                    <img class="chat-avatar" src="${avatar}" alt="Avatar">
                    <div class="chat-bubble">${text}</div>
                </div>
            `;

            document.getElementById("chat-messages").insertAdjacentHTML("beforeend", html);
            messages.scrollTop = messages.scrollHeight;
        }

        // Nhận realtime từ user → admin
        const channel = window.Echo.private("chat." + adminId);
        channel.listen(".MessageSent", (e) => {
            if (e.message.from_id == userId) {
                messages.insertAdjacentHTML("beforeend", `
                    <div style="text-align:left; margin:6px 0;">
                        <span style="background:white; padding:6px 10px; border-radius:6px;">
                            ${e.message.message}
                        </span>
                    </div>
                `);
                messages.scrollTop = messages.scrollHeight;
            }
        });

    });
    </script>

@endpush
