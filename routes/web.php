<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect('/chat'));
Route::get('/chat', fn() => view('chat'));
