<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">

                @foreach ($conversation as $item)
                    <div class="bg-indigo-300 p-4 mb-5">
                        <p class="font-bold">
                            {{ $item->user->name }}
                        </p>
                        <p class="text-black/80">
                            {{ $item->message }}
                        </p>
                        <p class="text-black/50">
                            {{ $item->created_at }}
                        </p>
                    </div>
                @endforeach

                <form wire:submit="save">
                    <input type="text" wire:model="message">
                    <button type="submit" class="py-2 px-4 bg-indigo-300 text-black rounded-lg">
                        Send
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
