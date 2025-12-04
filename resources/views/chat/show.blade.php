@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto py-6">

    <h1 class="text-xl font-bold mb-4">
        💬 Chat del Pedido #{{ $conversation->order->id }}
    </h1>

    <div id="messages"
         class="h-96 overflow-y-scroll p-4 bg-gray-100 rounded shadow space-y-3">

        @foreach($messages as $msg)
            @php
                $isMine = $msg->sender_id == auth()->id();
                $sender = $msg->sender->name ?? 'Usuario';
            @endphp

            <div class="max-w-[70%] p-2 rounded
                {{ $isMine ? 'bg-blue-200 ml-auto text-right' : 'bg-white' }}">

                <p class="text-xs text-gray-600 font-semibold">
                    {{ $isMine ? 'Tú' : $sender }}
                </p>

                <p>{{ $msg->text }}</p>
            </div>
        @endforeach

    </div>

    <form id="sendForm" method="POST" class="mt-4 flex gap-2">
        @csrf
        <input type="text" name="message" class="w-full p-2 border rounded"
               placeholder="Escribe un mensaje..." required>
        <button type="submit" class="px-4 bg-sky-600 text-white rounded">Enviar</button>
    </form>

</div>

<script>
let msgBox = document.getElementById('messages');
msgBox.scrollTop = msgBox.scrollHeight;

const myName = "{{ auth()->user()->name }}";

Echo.private("chat.{{ $conversation->id }}")
    .listen("NewMessage", (e) => {

        let sender = e.message.sender?.name ?? "Usuario";
        let isMine = e.message.sender_id == {{ auth()->id() }};

        msgBox.insertAdjacentHTML(
            'beforeend',
            `
            <div class="max-w-[70%] p-2 rounded ${isMine ? 'bg-blue-200 ml-auto text-right' : 'bg-white'}">
                <p class="text-xs text-gray-600 font-semibold">
                    ${isMine ? 'Tú' : sender}
                </p>
                <p>${e.message.text}</p>
            </div>
            `
        );

        msgBox.scrollTop = msgBox.scrollHeight;
    });


document.getElementById('sendForm').addEventListener('submit', function(e){
    e.preventDefault();

    let form = new FormData(this);
    let text = form.get("message");

    fetch("{{ route('chat.send', $conversation->id) }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Accept": "application/json"
        },
        body: form
    })
    .then(res => res.json())
    .then(data => {

        msgBox.insertAdjacentHTML(
            'beforeend',
            `
            <div class="max-w-[70%] p-2 rounded bg-blue-200 ml-auto text-right">
                <p class="text-xs text-gray-600 font-semibold">Tú</p>
                <p>${text}</p>
            </div>
            `
        );

        msgBox.scrollTop = msgBox.scrollHeight;
    });

    this.reset();
});
</script>

@endsection
