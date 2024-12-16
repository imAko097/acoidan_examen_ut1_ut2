<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class ModificarMensaje extends Controller
{
    // Agregar nuevos mensajes
    public function newMensaje(Request $request) {
        $mensaje = $request -> validate([
            'text' => 'required|max:50',
            'negrita' => 'boolean',
            'subrayado' => 'boolean',
        ], [
            'text.required' => 'El campo texto es obligatorio',
            'text.max' => 'No puede superar los 50 caracteres',
        ]);

        // Agregar en la base de datos
        Message::create($mensaje);

        return response() -> json([
            'MESSAGE' => 'Mensaje agregado correctamente'
        ]);
    }

    // Mostrar los mensajes en la vista
    public function mostrarMensaje($id) {
        $message = Message::findOrFail($id);
        $messages = Message::all();
        return view('messages', compact('messages', 'message'));
    }
    // 
    public function modificarMensaje(Request $request, $id) {
        $registro = Message::findOrFail($id);
        $datos = $request -> validate([
            'text' => 'required|max:50',
            'negrita' => 'boolean',
            'subrayado' => 'boolean',
        ], [
            'text.required' => 'Texto es obligatorio',
            'text.max' => 'No puede superar los 50 caracteres',
        ]);

        $registro_bd = new Message($datos);

        $registro_bd -> save();

        return response() -> json([
            'MESSAGE' => 'Mensaje editado correctamente'
        ]);
    }
}
