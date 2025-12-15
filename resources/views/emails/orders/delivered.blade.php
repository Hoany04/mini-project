<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>The order has been successfully delivered.</title>
</head>
<body>
  <h2>Hello {{ $order->user->name ?? 'Clent' }}</h2>
  <p>Order #{{ $order->id }} Your order has been successfully delivered. 🎉</p>
  <p><strong>Total amount:</strong> {{ $order->total_amount ?? '0' }}₫</p>
  <p><strong>Delivery date:</strong> {{ $order->shipping->delivered_at ?? now() }}</p>
</body>
</html>
