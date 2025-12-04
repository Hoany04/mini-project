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

?>
