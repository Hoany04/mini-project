<?php

namespace App\Observers;

use App\Mail\OrderShippedMail;
use App\Mail\OrderDeliveredMail;
use App\Mail\OrderCancelledMail;
use App\Mail\OrderRefundedMail;
use Illuminate\Support\Facades\Mail;
use App\Models\OrderShipping;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use App\Events\OrderShipped;
use App\Notifications\OrderStatusUpdatedNotification;

class OrderShippingObserver
{
    public function updating(OrderShipping $shipping)
    {
        // Lưu trạng thái cũ vào relation tạm, không ghi xuống DB
        $shipping->setRelation('old_status_for_log', $shipping->getOriginal('status'));
    }

    public function updated(OrderShipping $shipping)
    {
        if (!$shipping->isDirty('status')) return;

        $order = $shipping->order;

        if (!$order || !$order->user) return;

        switch ($shipping->status) {
            case 'shipping':
                Mail::to($order->user->email)->send(new OrderShippedMail($order));
                break;

            case 'delivered':
                Mail::to($order->user->email)->send(new OrderDeliveredMail($order));
                break;

            case 'cancelled':
                Mail::to($order->user->email)->send(new OrderCancelledMail($order));
                break;

            case 'refund':
                Mail::to($order->user->email)->send(new OrderRefundedMail($order));
                break;
        }
            // Đồng bộ trạng thái đơn hàng tương ứng
        $this->syncOrderStatus($shipping);

        $order->user->notify(new OrderStatusUpdatedNotification($order));

        \Log::info("🔔 Notification sent to user #{$order->user_id} for order #{$order->id}, status: {$shipping->status}");
    }

    protected function syncOrderStatus(OrderShipping $shipping)
    {
        $order = $shipping->order; // Quan hệ order()

        if (!$order) {
            Log::warning(" OrderShippingObserver: No related order found for shipping #{$shipping->id}");
            return;
        }

        // Map trạng thái giao hàng sang trạng thái đơn hàng
        $map = [
            'pending'   => 'pending',
            'shipping'   => 'shipped',
            'delivered' => 'completed',
            'cancelled' => 'cancelled',
        ];

        $newStatus = $map[$shipping->status] ?? 'pending';

        $order->update(['status' => $newStatus]);

        Log::info(" OrderShippingObserver: Updated order #{$order->id} to status '{$newStatus}'");
    }
}
