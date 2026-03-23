<div>
    @if(!$joined)
        <div class="flex flex-col items-center gap-4">
            <p class="text-green-400 font-mono text-sm">Elige tu nick para entrar al chat:</p>
            <form wire:submit="join" class="flex gap-2">
                <span class="text-green-400 font-mono py-2">&gt;</span>
                <input wire:model="username" placeholder="nick..."
                       class="bg-black border border-green-400 text-green-400 px-3 py-2 font-mono focus:outline-none focus:ring-1 focus:ring-green-400"
                       autofocus>
                <button type="submit"
                        class="border border-green-400 text-green-400 px-4 py-2 font-mono hover:bg-green-400 hover:text-black transition-colors">
                    ENTRAR
                </button>
            </form>
            @error('username')
                <p class="text-red-500 font-mono text-xs">{{ $message }}</p>
            @enderror
        </div>
    @else
        <div wire:poll.1s class="h-96 overflow-y-auto mb-4 border border-green-400 p-4 font-mono text-sm" id="messages">
            <p class="text-green-700">*** Conectado como {{ $username }} ***</p>
            @foreach($messages as $msg)
                <div class="text-green-400">[{{ $msg->created_at->format('H:i:s') }}] {{ $msg->username }} &gt; {{ $msg->content }}</div>
            @endforeach
        </div>

        <form wire:submit="sendMessage" class="flex gap-2">
            <span class="text-green-400 font-mono py-2">{{ $username }} &gt;</span>
            <input wire:model="message" placeholder="Escribe un mensaje..."
                   class="flex-1 bg-black border border-green-400 text-green-400 px-3 py-2 font-mono focus:outline-none focus:ring-1 focus:ring-green-400"
                   autofocus>
            <button type="submit"
                    class="border border-green-400 text-green-400 px-4 py-2 font-mono hover:bg-green-400 hover:text-black transition-colors">
                ENVIAR
            </button>
        </form>
        @error('message')
            <p class="text-red-500 font-mono text-xs mt-1">{{ $message }}</p>
        @enderror
    @endif
</div>
