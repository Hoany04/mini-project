<?php

namespace App\Notifications;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification implements ShouldQueue, ShouldBroadcast
{
    use Queueable;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message'  => "Đơn hàng #{$this->order->id} mới từ khách {$this->order->user->username}",
            'order_id' => $this->order->id,
            'user_name'=> $this->order->user->username,
            'total'    => $this->order->total_amount,
        ];
    }

     /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */

    public function toArray($notifiable)
    {
        return [
            'message'  => "Đơn hàng #{$this->order->id} mới từ khách {$this->order->user->username}",
            'order_id' => $this->order->id,
            'user_name'=> $this->order->user->username,
            'total'    => $this->order->total_amount,
        ];
    }

    public function toBroadcast($notifiable)
    {
        \Log::info("🎯 Broadcasting NewOrderNotification");
        return new BroadcastMessage([
            'message'  => "Đơn hàng #{$this->order->id} mới từ khách {$this->order->user->username}",
            'order_id' => $this->order->id,
            'user_name'=> $this->order->user->username,
            'total'    => $this->order->total_amount,
        ]);
    }

    public function broadcastOn()
    {
        // Phát ra chung cho tất cả admin
        return new PrivateChannel('admin.notifications');
    }
    public function broadcastAs()
    {
        return 'NewOrderNotification';
    }
}
