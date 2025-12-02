<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use NotificationChannels\WebPush\WebPushMessage;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderStatusUpdatedNotification extends Notification implements ShouldQueue, ShouldBroadcast
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $order;
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        return ['database', 'broadcast', 'webpush'];
    }

    /**
     * Get the mail representation of the notification.
     */

    public function toDatabase($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'status' => $this->order->status,
            'message' => "Don hang #{$this->order->id} da cap nhat sang: {$this->order->status}",
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'order_id' => $this->order->id,
            'status' => $this->order->status,
            'message' => "Don hang #{$this->order->id} da cap nhat sang: {$this->order->status}",
        ]);
    }

    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title('Đơn hàng mới')
            ->icon('/icon.png')
            ->body("Đơn hàng #{$this->order->id} đã cập nhật sang: {$this->order->status}")
            ->action('Xem chi tiết', url("/orders/{$this->order->id}"));
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'status'   => $this->order->status,
            'message'  => "Đơn hàng #{$this->order->id} đã cập nhật sang: {$this->order->status}",
        ];
    }

    public function broadcastOn()
    {
        return new PrivateChannel('user.' . $this->order->user_id);
    }

}
