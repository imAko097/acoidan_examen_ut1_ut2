<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class ModificarMensaje extends Controller
{

    //
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
            'negrita_subrayado' => 'required|in:0,1',
        ], [
            'text.required' => 'El campo texto es obligatorio',
            'negrita_subrayado.required' => 'Debes seleccionar un estilo',
            'negrita_subrayado.in' => 'Estilo inválido'
        ]);

        $registro_bd = new Message($datos);

        $registro_bd -> save();

        return view('messages', compact('messages', 'message'));
    }
}
