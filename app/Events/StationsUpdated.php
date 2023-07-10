<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StationsUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

//    public Collection $stations;

    /**
     * Create a new event instance.
     */
//    public function __construct(Collection $stations)
//    {
//        $this->stations = $stations;
//    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('public.stations.1'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'stations-status';
    }

    public function broadcastWith(): array
    {
//        return $this->stations->toArray();
        return [
            'message' => 'Hello World!!!',
        ];
    }
}
