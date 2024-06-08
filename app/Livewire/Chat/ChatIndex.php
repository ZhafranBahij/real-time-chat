<?php

namespace App\Livewire\Chat;

use App\Events\ChatEvent;
use App\Models\Chat;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;


class ChatIndex extends Component
{
    use LivewireAlert;

    public $conversation = [];

    #[Validate]
    public $message = '';

    public function mount()
    {
        $this->conversation = Chat::with('user')
        // ->limit(2)
                                // ->latest()
                                ->get()
                                ->toArray();
        // dd($this->conversation);
    }

    public function rules()
    {
        return [
            'message' => 'required',
        ];
    }

    public function save()
    {
        $validated = $this->validate();
        $validated['user_id'] = auth()->user()->id;

        ChatEvent::dispatch($validated);

        $this->alert('success', 'Message has been sended');

        // $this->redirectRoute('chat', navigate: true);
    }

    #[On('echo:chat,ChatEvent')]
    public function saveMessage($chat)
    {
        $this->conversation[] = $chat;
    }

    #[Layout('layouts.app')]
    public function render()
    {

        return view('livewire.chat.chat-index');
    }
}
