@component('mail::message')
# Báo cáo đơn hàng chưa xử lý

Xin chào Admin,

Dưới đây là danh sách các đơn hàng chưa được xử lý (tính đến {{ now()->format('d/m/Y') }}):

@foreach ($orders as $order)
- **Mã đơn:** {{ $order->id }}  
  **Khách hàng:** {{ $order->user->name ?? 'N/A' }}  
  **Tổng tiền:** {{ number_format($order->total_amount, 0, ',', '.') }}₫  
  **Ngày đặt:** {{ $order->created_at->format('d/m/Y H:i') }}
@endforeach

@component('mail::button', ['url' => route('admin.orders.index')])
Xem chi tiết
@endcomponent

Cảm ơn,<br>
{{ config('app.name') }}
@endcomponent
