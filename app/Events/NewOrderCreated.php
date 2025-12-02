<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewOrderCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $order;
    public function __construct(Order $order)
    {
        $this->order = $order->load('user');
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): Channel
    {
        return new Channel('orders');
    }

    public function broadcastAs()
    {
        return 'new-order';
    }

    public function broadcastWith(): array
    {
        return [
            'order' => [
                'id' => $this->order->id,
                'user_id' => $this->order->user_id,
                'total_amount' => $this->order->total_amount,
                'status' => $this->order->status,
                'created_at' => $this->order->created_at->toDateTimeString(),
                'user' => [
                    'id' => $this->order->user->id,
                    'username' => $this->order->user->username,
                    'email' => $this->order->user->email,
                ],
            ],
        ];
    }
}
