<?php

namespace App\Events;

use App\Models\Chat;
use GuzzleHttp\Psr7\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chat;

    /**
     * Create a new event instance.
     */
    public function __construct($new_chat)
    {
        $chat = Chat::create([
            'message' => $new_chat['message'],
            'user_id' => $new_chat['user_id'],
        ]);

        $this->chat = $chat->toArray();
        $this->chat['username'] = auth()->user()->name;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('chat'),
        ];
    }
}
