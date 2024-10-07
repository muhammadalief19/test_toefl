<?php
namespace App\Events;

use App\Models\PrivateMessage;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\PrivateChannel;

class PrivateMessageUpdated
{
    use Dispatchable, InteractsWithSockets;

    public $message;

    public function __construct(PrivateMessage $message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('private-messages.' . $this->message->recipient_id);
    }
}
