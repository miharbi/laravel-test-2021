<?php

namespace App\Actions;

use App\Interfaces\IProcessMessage;
use App\Events\MessageSent;

class ProcessMessage implements IProcessMessage
{
    /**
     * Process the chat message.
     *
     * @param  int  $user_id
     * @param  string  $message
     */
    public function process(int $user_id, string $message)
    {
        broadcast(new MessageSent($user_id, $message))->toOthers();
        return $message;
    }
}
