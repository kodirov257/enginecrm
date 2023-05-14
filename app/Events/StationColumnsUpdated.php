<?php

namespace App\Events;

use App\Entity\Station;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StationColumnsUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Station $station;

    public function __construct(Station $station)
    {
        $this->station = $station;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array|Channel
    {
        return new PrivateChannel('stations.' . $this->station->station);
    }

    public function broadcastAs(): string
    {
        return 'station-status';
    }

    public function broadcastWith(): array
    {
        return $this->station->toArray();
    }
}
