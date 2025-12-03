<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('orders', function ($user) {
    return true;
});

Broadcast::channel('user.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('admin.notifications', function ($user) {
    // Chỉ admin mới được subscribe
    return $user->role === 'admin';
});


// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });
?>
