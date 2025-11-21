<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold">Notificaciones</h2>
    </x-slot>

    <div class="space-y-4 mt-6">

        @forelse ($notifications as $n)
            <div class="p-4 rounded shadow
                {{ $n->is_read ? 'bg-gray-100' : 'bg-indigo-50' }}">

                <p class="text-gray-800">{{ $n->message }}</p>
                <p class="text-sm text-gray-500">{{ $n->created_at->diffForHumans() }}</p>

                @if(!$n->is_read)
                    <form action="{{ route('notifications.read', $n->id) }}" method="POST" class="mt-2">
                        @csrf
                        <button class="px-3 py-1 bg-indigo-600 text-white rounded">
                            Marcar como leída
                        </button>
                    </form>
                @endif
            </div>
        @empty
            <p class="text-gray-600">No tienes notificaciones.</p>
        @endforelse

    </div>
</x-app-layout>
