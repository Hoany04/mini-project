<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    public $order;
    public function __construct( Order $order )
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'user_id' => $this->order->user_id,
            'total' => $this->order->total_amount ?? $this->order->total,
            'created_at' => $this->order->created_at->toDateTimeString(),
            'message' => "Don hang moi #{$this->order->id}",
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'order_id' => $this->order->id,
            'user_id' => $this->order->user_id,
            'total' => $this->order->total_amount ?? $this->order->total,
            'created_at' => $this->order->created_at->toDateTimeString(),
            'message' => "Don hang moi #{$this->order->id}",
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Don hang moi')
            ->line("Co don hang moi #{$this->order->id}")
            ->action('Xem don hang', url('/admin/orders/'. $this->order->id));
    }
}
