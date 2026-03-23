# Retro Chat v1.0

Chat en tiempo real con estilo terminal retro, construido con Laravel y **Livewire polling** — sin WebSockets, sin Pusher, sin Redis, sin SSE.

```
 ╔══════════════════════════════════╗
 ║       RETRO CHAT v1.0           ║
 ║   ░░░ Laravel + Livewire ░░░    ║
 ╚══════════════════════════════════╝
```

## Stack

- **Laravel 13** + **Livewire 4** (envío y recepción de mensajes con polling)
- **Tailwind CSS** + **Vite** (diseño retro terminal)
- **SQLite** (base de datos sin configuración)

## Requisitos

- PHP 8.2+
- Composer
- Node.js + npm

## Instalación

```bash
composer install
npm install
npm run build
php artisan migrate
```

## Ejecutar

```bash
php artisan serve
```

Abre `http://localhost:8000/chat` en tu navegador.

## Cómo funciona

Livewire hace polling cada 1 segundo con `wire:poll.1s`. Cada segundo el componente re-renderiza y consulta todos los mensajes de SQLite.

```
Navegador                          Laravel
   |                                  |
   |-- POST /livewire/update ------->|  (Livewire envía mensaje, guarda en SQLite)
   |<-- HTML actualizado ------------|
   |                                  |
   |-- POST /livewire/update ------->|  (poll cada 1s, re-render con mensajes nuevos)
   |<-- HTML actualizado ------------|
   |         ... cada segundo ...     |
```

- **`wire:poll.1s`** en el div de mensajes hace que Livewire re-renderice el componente cada segundo
- Cada render consulta `Message::orderBy('id')->get()` y pinta todos los mensajes
- Livewire hace diff del HTML y solo actualiza lo que cambió en el DOM

## Estructura clave

```
app/
├── Livewire/ChatBox.php                 # Componente: elegir nick + enviar mensaje + cargar mensajes
└── Models/Message.php                   # Modelo: username, content

resources/views/
├── chat.blade.php                       # Página principal
└── livewire/chat-box.blade.php          # Vista del componente con wire:poll.1s

routes/web.php                           # GET /chat
```

## Limitaciones (es una demo)

- Sin autenticación: el nick es solo texto en memoria, sin persistencia.
- Delay máximo de ~1 segundo (polling interval).
- Cada poll es una petición HTTP completa — para pocos usuarios está bien, no escala a muchos.
