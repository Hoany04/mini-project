<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>The order has been successfully delivered.</title>
</head>
<body>
  <h2>Hello {{ $order->user->name ?? 'Client' }}</h2>
  <p>Order #{{ $order->id }} Your order has been canceled. ❌</p>
</body>
</html>
