<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajes</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Prueba superada</h1>
        @if($messages->isEmpty())
            <p>No hay mensajes en la base de datos</p>
        @else
            <ul>
                @foreach($messages as $message)
                    @if ($message -> subrayado)
                        <li><u>{{ $message->text }}</u></li>
                    @elseif ($message -> negrita)
                        <li><b>{{ $message->text }}</b></li>
                    @else
                        <li>{{ $message->text }}</li>
                    @endif
                    <a href="{{ route('mostrar.formulario.modificar', $message -> id) }}">Modificar mensaje</a>
                @endforeach
            </ul>
        @endif
    </div>
    <form action="{{ route('modificar.duda', $message -> id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="texto">Texto:
            <input type="text" name="text" value="{{ $message -> text}}">
        </label>
        @if ($errors->has('text'))
            <span style="color: red;">{{ $errors->first('text') }}</span><br>
        @endif
        <select name="negrita_subrayado" id="negrita_subrayado">Seleccione estilo:
            <option value="0" {{ $message -> negrita_subrayado == '0' ? 'selected' : '' }}>Subrayado</option>
            <option value="1" {{ $message -> negrita_subrayado == '1' ? 'selected' : '' }}>Negrita</option>
        </select>
        @if ($errors->has('negrita_subrayado'))
            <span style="color: red;">{{ $errors -> first('negrita_subrayado') }}</span><br>
        @endif
        <input type="submit">
    </form>
</body>
</html>