@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto py-6">

    <h1 class="text-xl font-bold mb-4">
        💬 Chat del Pedido #{{ $conversation->order->id }}
    </h1>

    <div id="messages"
         class="h-96 overflow-y-scroll p-4 bg-gray-100 rounded shadow space-y-3">

        @foreach($messages as $msg)
            <div class="p-2 rounded max-w-[70%]
                {{ $msg->sender_id == auth()->id() ? 'bg-blue-200 ml-auto text-right' : 'bg-white' }}">
                {{ $msg->text }}
            </div>
        @endforeach

    </div>

 <form id="sendForm" method="POST" class="mt-4 flex gap-2">
    @csrf
    <input type="text" name="message" class="w-full p-2 border rounded"
           placeholder="Escribe un mensaje..." required>
    <button type="submit" class="px-4 bg-sky-600 text-white rounded">Enviar</button>
</form>

<script>
let msgBox = document.getElementById('messages');
msgBox.scrollTop = msgBox.scrollHeight;

Echo.private("chat.{{ $conversation->id }}")
    .listen("NewMessage", (e) => {
        msgBox.insertAdjacentHTML(
            'beforeend',
            `<div class="p-2 rounded bg-white max-w-[70%]">${e.message.text}</div>`
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
        // Lo agrega instantáneo al chat
        msgBox.insertAdjacentHTML(
            'beforeend',
            `<div class="p-2 rounded bg-blue-200 ml-auto text-right max-w-[70%]">${text}</div>`
        );
        msgBox.scrollTop = msgBox.scrollHeight;
    });

    this.reset();
});
</script>



@endsection
