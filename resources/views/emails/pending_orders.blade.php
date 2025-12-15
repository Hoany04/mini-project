@component('mail::message')
# Report unprocessed orders

Hello Admin,

Below is a list of orders that have not yet been processed (as of now {{ now()->format('d/m/Y') }}):

@foreach ($orders as $order)
- **Order code:** {{ $order->id }}
  **Client:** {{ $order->user->name ?? 'N/A' }}
  **Total amount:** {{ number_format($order->total_amount, 0, ',', '.') }}₫
  **Date of booking:** {{ $order->created_at->format('d/m/Y H:i') }}
@endforeach

@component('mail::button', ['url' => route('admin.orders.index')])
See details
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
