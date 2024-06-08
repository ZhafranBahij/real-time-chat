<?php

namespace App\Livewire\Chat;

use App\Models\Chat;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class ChatIndex extends Component
{
    use LivewireAlert;

    public $conversation;

    #[Validate]
    public $message = '';

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

        Chat::create($validated);

        $this->alert('success', 'Message has been sended');

        $this->redirectRoute('chat', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {

        $this->conversation = Chat::all();

        return view('livewire.chat.chat-index');
    }
}
