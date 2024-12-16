<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModificarMensaje;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/messages', function () {
    $messages = \App\Models\Message::all();
    return view('messages', ['messages' => $messages]);
});

Route::post('/messages', [ModificarMensaje::class, 'newMensaje']); // Crea mensaje

Route::get('/formMessage/{id}', [ModificarMensaje::class, 'getMensaje']); // Obtiene 1 mensaje

Route::put('/modMessages/{id}', [ModificarMensaje::class, 'modificarMensaje']); // Modifica mensaje