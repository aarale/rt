@section('scripts')
<script>
    import Echo from 'laravel-echo';
</script>

<script>
    (function(){
        const conversationId = {{ $conversation->id }};
        const orderId = {{ $order->id }};

        const messagesBox = document.querySelector('#messagesBox');
        if (messagesBox) messagesBox.scrollTop = messagesBox.scrollHeight;

        window.Echo.private('conversation.'+conversationId)
            .listen('NewMessage', (e) => {
                const html = `<div class="${e.sender_id == {{ auth()->id() }} ? 'text-right' : ''}">
                    <p class="inline-block px-4 py-2 rounded-lg ${e.sender_id == {{ auth()->id() }} ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-900'}">
                        ${e.text}
                    </p>
                </div>`;
                document.querySelector('#messagesBox').insertAdjacentHTML('beforeend', html);
                messagesBox.scrollTop = messagesBox.scrollHeight;
            });

    })();
</script>
@endsection
