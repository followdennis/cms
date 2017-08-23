<?php

namespace App\Events;

use App\LiZhi;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderShipped
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $lizhiEvent;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(LiZhi $lizhi)
    {
        //
        $this->lizhiEvent = $lizhi;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}