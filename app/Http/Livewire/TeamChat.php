<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Interfaces\IProcessMessage;
use App\Models\User;
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
        $this->messages = [];
    }

    public function render()
    {
        return view('livewire.team-chat');
    }

    public function sendMessage(IProcessMessage $action)
    {
        $validatedData = $this->validate();
        $message = $action->process($this->user->id, $validatedData['message']);
        $this->messages[] = [
            'userId' => $this->user->id,
            'userName' => $this->user->name,
            'userMail' => $this->user->email,
            'message' => $message
        ];
    }

    public function messageReceived($data)
    {
        $user = User::find($data['user']);
        if ($user->id !== Auth::user()->id) {
            $this->messages[] = [
                'userId' => $user->id,
                'userName' => $user->name,
                'userMail' => $user->email,
                'message' => $data['message']
            ];
        }
    }
}
