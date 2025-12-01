import axios from 'axios';

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// Đăng ký service worker
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/sw.js')
        .then(registration => {
            console.log("✅ Service Worker đã đăng ký:", registration);

            // Xin quyền hiển thị notification
            Notification.requestPermission().then(permission => {
                if (permission === 'granted') {
                    console.log("🔔 Quyền notification đã được cấp");

                    // Tạo subscription
                    registration.pushManager.subscribe({
                        userVisibleOnly: true,
                        applicationServerKey: '<VAPID_PUBLIC_KEY_BASE64>'
                    }).then(subscription => {
                        console.log("📡 Subscription:", subscription);

                        // Gửi subscription lên server để lưu vào DB
                        axios.post('/push-subscribe', subscription)
                            .then(() => console.log("✅ Subscription đã gửi lên server"))
                            .catch(err => console.error("❌ Lỗi gửi subscription:", err));
                    });
                } else {
                    console.warn("⚠️ Người dùng chưa cấp quyền notification");
                }
            });
        })
        .catch(err => console.error("❌ Lỗi đăng ký service worker:", err));
}



window.Pusher = Pusher;
// console.log("🔧 Echo đang chạy...");

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
    authEndpoint: '/broadcasting/auth',
});

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

import './echo';
