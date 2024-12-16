<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/script.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Mensajes</title>
</head>
<body>
    <div class="container">
        <h1>Prueba superada</h1>
        <h2>Escribir un nuevo mensaje</h2>
        <form id="formNuevo" method="POST">
            <div>
                <label for="nuevoMensaje">Escribe un mensaje:</label>
                <textarea name="text" id="nuevoMensaje" style="resize: none;"></textarea>
            </div>
            <div>
                <span>Añade estilos:</span>
                <label for="negrita">Negrita</label>
                <input type="checkbox" name="negrita" id="negrita">
                <label for="subrayado">Subrayado</label>
                <input type="checkbox" name="subrayado" id="subrayado">
            </div>
            <div>
                <button type="submit">
                    Agregar
                </button>
            </div>            
        </form>
        <div id="mensajeAviso"></div>
        @if($messages->isEmpty())
            <p>No hay mensajes en la base de datos</p>
        @else
            <ul>
                @foreach($messages as $message)
                    @if ($message->subrayado && !$message->negrita)
                        <li><u>{{ $message->text }}</u></li>
                    @elseif ($message->negrita && !$message->subrayado)
                        <li><b>{{ $message->text }}</b></li>
                    @elseif ($message->negrita && $message->subrayado)
                        <li><u><b>{{ $message->text }}</b></u></li>
                    @else
                        <li>{{ $message->text }}</li>
                    @endif
                    <button id="btnModificar-{{ $message->id }}">
                        &#9999; Modificar
                    </button>
                @endforeach
            </ul>
        @endif
        <div id="divModificar">
            <form method="POST">
                @csrf
                @method('PUT')
                <div>
                    <label for="nuevoMensaje">Escribe un mensaje:</label><br>
                    <textarea name="text" id="nuevoMensajeMod" style="resize: none;">
                    </textarea>
                </div>
                <div>
                    <span>Añade estilos:</span>
                    <label for="negrita">Negrita</label>
                    <input type="checkbox" name="negrita" id="negritaMod">
                    <label for="subrayado">Subrayado</label>
                    <input type="checkbox" name="subrayado" id="subrayadoMod">
                </div>
                <div>
                    <button type="submit">
                        Modificar
                    </button>
                </div> 
            </form>
        </div>
    </div>
</body>
</html>