# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Simple chat application built with Laravel using Livewire polling for real-time messaging — no WebSockets, no SSE. Demo/student-level project using SQLite.

## Tech Stack

- **Laravel 13** (PHP framework)
- **Livewire 4** (sending and receiving messages via `wire:poll.1s`)
- **Tailwind CSS** (retro terminal-style UI: black background, green monospace text)
- **Vite** (asset bundling)
- **SQLite** (database for development)

## Common Commands

```bash
# Install dependencies
composer install && npm install

# Run migrations
php artisan migrate

# Start development server
php artisan serve

# Compile assets (dev)
npm run dev

# Compile assets (production)
npm run build
```

## Architecture

- **Livewire component** (`ChatBox`): Handles nick selection, message submission, and message loading. Uses `wire:poll.1s` to re-render every second, querying all messages from SQLite.
- **No SSE, no WebSockets**: Real-time updates are achieved purely through Livewire's polling mechanism. Each poll is a standard HTTP POST that re-renders the component server-side; Livewire diffs the HTML and patches the DOM.
- **Nick-based identity**: No authentication — user picks a nick stored only in Livewire component memory. Lost on page reload.

## Key Design Decisions

- Livewire polling chosen over SSE/WebSockets to avoid persistent connections and multi-worker server requirements.
- SQLite chosen for zero-config database setup.
- Single-page chat UI with retro terminal aesthetic (Tailwind utility classes).
- This is intentionally simple and does not scale — each connected client generates an HTTP request every second.
