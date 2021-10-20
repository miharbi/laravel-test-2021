<?php

namespace App\Actions;

use App\Interfaces\IProcessMessage;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;


class ProcessMessage implements IProcessMessage
{
    /**
     * Process the chat message.
     *
     * @param  string  $message
     */
    public function process(string $message)
    {
        $user = Auth::user();

        $message = $user->messages()->create([
            'message' => $message
        ]);

        broadcast(new MessageSent($user, $message->message))->toOthers();

        return $message->message;
    }
}
