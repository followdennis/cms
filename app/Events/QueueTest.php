<?php

namespace App\Events;

use App\Chefs;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class QueueTest
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $chefsEvent;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Chefs $chefs)
    {
        //
        $this->chefsEvent = $chefs;
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
