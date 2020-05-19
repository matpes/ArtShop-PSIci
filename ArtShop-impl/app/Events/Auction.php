<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class Auction
 * @package App\Events
 *
 * Event koji se stvara kada se napravi aukcija
 */
class Auction
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $picture;

    /**
     * Auction constructor.
     * @param $picture
     *
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($picture)
    {
        //
        $this->picture = $picture;
    }


}
