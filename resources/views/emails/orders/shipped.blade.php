<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Đơn hàng đã giao thành công</title>
</head>
<body>
  <h2>Xin chào {{ $order->user->name ?? 'Khách hàng' }}</h2>
  <h3>Đơn hàng #{{ $order->id }} đang được giao</h3>
<p>Cảm ơn bạn đã mua hàng! Đơn hàng của bạn đang trên đường đến 🚚</p>
</body>
</html>
