self.addEventListener("notificationclick", function(event) {
    console.log("🔔 Notification clicked", event.notification.data);

    event.notification.close();

    const data = event.notification.data || {};
    const orderId = data.order_id;
    // const type = data.type || "user";  // default = user
    const userId = data.user_id;
    const adminId = data.admin_id;

    const type = data.type;

    let url = "/";  // fallback

    switch (type) {

        case "admin":
            url = `/admin/orders/${orderId}/show`;
            break;

        case "user":
            url = `/client/${orderId}`;
            break;

        case "chat_admin":
            url = `/admin/chat/${userId}`;
            break;

        case "chat_user":
            url = `/`;
            break;

        default:
            console.warn("Không có type hợp lệ → fallback /");
            break;
    }

    event.waitUntil(
        clients.matchAll({ type: "window", includeUncontrolled: true })
            .then(windowClients => {

                for (let client of windowClients) {
                    // Match URL
                    if (client.url.includes(url) && "focus" in client) {
                        return client.focus();
                    }
                }

                    return clients.openWindow(url);
            })
    );
});
