<?php

namespace App\Http\Livewire;

use App\Interfaces\IProcessMessage;
use App\Models\User;
use App\Models\Message;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class TeamChat extends Component
{
    public $user;
    public $message;
    public $messages;

    protected $rules = [
        'message' => 'required',
    ];

    protected $listeners = [
        'messageReceived'
    ];

    public function mount()
    {
        $this->user = auth()->user();
        $this->message = "";
        $this->messages = $this->fetchMessages();
    }

    public function render()
    {
        return view('livewire.team-chat');
    }

    public function sendMessage(IProcessMessage $action)
    {
        $validatedData = $this->validate();
        $message = $action->process($validatedData['message']);
        $this->message = "";
        $this->messages[] = [
            'user_id' => $this->user->id,
            'user' => $this->user,
            'message' => $message
        ];
    }

    public function messageReceived($data)
    {
        $user = User::find($data['user_id']);
        if ($user->id !== Auth::user()->id) {
            $this->messages[] = [
                'user_id' => $user->id,
                'user' => $user,
                'message' => $data['message']
            ];
        }
    }

    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages()
    {
        $messages =  Message::with('user')
            ->latest()
            ->limit(8)
            ->get()
            ->sortBy([['id', 'asc']])
            ->toArray();

        return $messages;
    }
}
