<?php

namespace App\Livewire;

use App\Models\Message;
use Livewire\Component;

class ChatBox extends Component
{
    public string $username = '';
    public string $message = '';
    public bool $joined = false;

    public function join()
    {
        $this->validate(['username' => 'required|min:2|max:20']);
        $this->joined = true;
    }

    public function sendMessage()
    {
        $this->validate(['message' => 'required|max:500']);

        Message::create([
            'username' => $this->username,
            'content' => $this->message,
        ]);

        $this->message = '';
    }

    public function render()
    {
        $messages = $this->joined ? Message::orderBy('id')->get() : collect();

        return view('livewire.chat-box', ['messages' => $messages]);
    }
}
