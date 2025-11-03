<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Đơn hàng đã giao thành công</title>
</head>
<body>
  <h2>Xin chào {{ $order->user->name ?? 'Khách hàng' }}</h2>
  <p>Đơn hàng #{{ $order->id }} của bạn đã được giao thành công 🎉</p>
  <p><strong>Tổng tiền:</strong> {{ $order->total_amount ?? '0' }}₫</p>
  <p><strong>Ngày giao:</strong> {{ $order->shipping->delivered_at ?? now() }}</p>
</body>
</html>
