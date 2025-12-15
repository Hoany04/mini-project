<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>The order has been successfully delivered.</title>
</head>
<body>
  <h2>Hello {{ $order->user->name ?? 'Client' }}</h2>
  <h3>Order #{{ $order->id }} currently being delivered</h3>
<p>Thank you for your purchase! Your order is on its way. 🚚</p>
</body>
</html>
