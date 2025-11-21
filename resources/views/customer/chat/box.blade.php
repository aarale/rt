@extends('layouts.app')

@section('content')
<h2>Chat con el vendedor</h2>

<div id="chat-box">
    @foreach($conversation->messages as $message)
        <div><strong>{{ $message->sender->name }}:</strong> {{ $message->text }}</div>
    @endforeach
</div>

<form method="POST" action="{{ route('messages.store', $conversation->id) }}">
    @csrf
    <input type="text" name="text" placeholder="Escribe tu mensaje..." required>
    <button type="submit">Enviar</button>
</form>
@endsection
