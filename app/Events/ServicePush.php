<?php
/**
 * Created by PhpStorm
 * User: pl
 * Date: 2020/9/10
 * Time: 16:16
 */

namespace App\Events;


use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ServicePush implements ShouldBroadcast
{
    use SerializesModels;

    public $user;

    /**
     * ServicePush constructor.
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }


    /**
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return  new PrivateChannel('user.'.$this->user->id);
    }

}


