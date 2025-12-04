self.addEventListener("notificationclick", function(event) {
    console.log("🔔 Notification clicked", event.notification.data);

    event.notification.close();

    const data = event.notification.data || {};
    const orderId = data.order_id;
    const type = data.type || "user";  // default = user

    let url = "/";  // fallback

    // ---- URL cho admin ----
    if (type === "admin") {
        url = `/admin/orders/${orderId}/show`;
    }

    // ---- URL cho user ----
    if (type === "user") {
        url = `/client/${orderId}`;
    }

    event.waitUntil(
        clients.matchAll({ type: "window", includeUncontrolled: true })
            .then(windowClients => {

                for (let client of windowClients) {
                    // Match URL
                    if (client.url.endsWith(url) && "focus" in client) {
                        return client.focus();
                    }
                }

                if (clients.openWindow) {
                    return clients.openWindow(url);
                }
            })
    );
});
