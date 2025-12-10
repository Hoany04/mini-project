<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('orders', function ($user) {
    return true;
});

Broadcast::channel('user.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('admin.notifications', function ($user) {
    return $user->role_id === 1;   // chỉ admin mới nghe được
});

Broadcast::channel('chat.{userId}', function ($user, $userId) {
    // Cho phép nếu user đang đăng nhập là admin hoặc chính user đó
    return (int) $user->id === (int) $userId || $user->role_id === 1;
});

?>
