<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retro Chat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-black min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-2xl">
        <pre class="text-green-400 font-mono text-center mb-2 text-xs sm:text-sm">
 ╔══════════════════════════════════╗
 ║       RETRO CHAT v1.0           ║
 ║   ░░░ Laravel + Livewire ░░░    ║
 ╚══════════════════════════════════╝
        </pre>
        <p class="text-green-700 font-mono text-xs text-center mb-4">[ Polling cada 1s con Livewire ]</p>

        <livewire:chat-box />
    </div>

    @livewireScripts

    <script>
        // Auto-scroll al fondo cuando Livewire actualiza los mensajes
        Livewire.hook('morph.updated', () => {
            const div = document.getElementById('messages');
            if (div) div.scrollTop = div.scrollHeight;
        });
    </script>
</body>
</html>
