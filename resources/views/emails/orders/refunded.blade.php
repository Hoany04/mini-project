<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Đơn hàng đã giao thành công</title>
</head>
<body>
  <h2>Xin chào {{ $order->user->name ?? 'Khách hàng' }}</h2>
  <p>Đơn hàng #{{ $order->id }} của bạn đã hoàn tiền thành công 💸</p>
</body>
</html>
