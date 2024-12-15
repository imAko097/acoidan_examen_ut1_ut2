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

Route::post('/messages', [ModificarMensaje::class, 'newMensaje']);

Route::get('/messages/{id}', [ModificarMensaje::class, 'mostrarMensaje']) -> name('mostrar.formulario.modificar');

Route::put('/messages/{id}', [ModificarMensaje::class, 'modificarMensaje']) -> name('modificar.duda');