<?php

namespace App\Actions;

use App\Interfaces\IProcessMessage;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


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

        $this->checkForDailyMeeting($message->message);

        broadcast(new MessageSent($user, $message->message))->toOthers();

        return $message->message;
    }

    /**
     * Process the chat message.
     *
     * @param  string  $message
     */
    public function checkForDailyMeeting(string $message)
    {
        if (Str::startsWith($message, '@daily ')) {
            $columns = explode('#', str_replace('@daily ', '', $message));
            $columnsInfo = [];
            foreach ($columns as $column) {
                $column = trim($column);
                if (Str::startsWith($column, ['done:', 'doing:', 'blocking:', 'todo:'])) {
                    $columnInfo = explode(':', $column);
                    $columnsInfo[trim($columnInfo[0])] = trim($columnInfo[1]);
                }
            }
            if (count($columnsInfo)) {
                $user = Auth::user();
                $message = $user->daily_meetings()->create($columnsInfo);
            }
        }
    }
}
