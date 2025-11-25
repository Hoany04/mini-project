<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('orders', function ($user) {
    return true;
});

Broadcast::channel('user.{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
});


// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });
?>
