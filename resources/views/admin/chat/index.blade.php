@extends('layouts.AdminLayout')

@section('content')
<div id="chat-box"
    data-admin_id="{{ auth()->id() }}"
    data-user_id="{{ $userId }}">

    <div id="chat-messages" style="height: 400px; overflow-y: auto; background:#f4f4f4; padding:10px;">
        @foreach($messages as $msg)
            <div style="margin:6px 0; text-align: {{ $msg->from_id == auth()->id() ? 'right' : 'left' }}">
                <span style="background:#fff; padding:6px 10px; border-radius:6px;">
                    {{ $msg->message }}
                </span>
            </div>
        @endforeach
    </div>

    <div style="display:flex; margin-top:10px;">
        <input id="chat-input" class="form-control" placeholder="Nhập tin nhắn...">
        <button id="chat-send" class="btn btn-primary ms-2">Gửi</button>
    </div>
</div>
@endsection
@section('js')
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
        function appendMyMessage(text) {
            messages.insertAdjacentHTML("beforeend", `
                <div style="text-align:right; margin:6px 0;">
                    <span style="background:#d1efff; padding:6px 10px; border-radius:6px;">
                        ${text}
                    </span>
                </div>
            `);
            messages.scrollTop = messages.scrollHeight;
        }

        // Nhận realtime từ user → admin
        const channel = window.Echo.private("chat." + userId);
        channel.listen(".message.sent", (e) => {
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

@endsection
