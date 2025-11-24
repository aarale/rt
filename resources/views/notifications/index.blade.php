<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-gray-800">🔔 Notificaciones</h2>
    </x-slot>

    <div class="mt-6 space-y-4">
        @forelse ($notifications as $n)
            <div class="relative bg-white border {{ $n->is_read ? 'border-gray-200' : 'border-indigo-300' }} rounded-lg shadow-sm p-5 transition hover:shadow-md">
                <div class="flex items-start gap-4">
                    <!-- Icono -->
                    <div class="flex-shrink-0">
                        @if($n->is_read)
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M9 12l2 2l4 -4m5 1a9 9 0 11-18 0a9 9 0 0118 0z" />
                            </svg>
                        @else
                            <svg class="w-6 h-6 text-indigo-500 animate-pulse" fill="none" stroke="currentColor"
                                 stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C8.67 6.165 7 8.388 7 11v3.159c0 .538-.214 1.055-.595 1.436L5 17h5m5 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        @endif
                    </div>

                    <!-- Mensaje -->
                    <div class="flex-1">
                        <p class="text-gray-800 text-base font-medium">
                            {{ $n->message }}
                        </p>
                        <p class="text-sm text-gray-500 mt-1">
                            {{ $n->created_at->diffForHumans() }}
                        </p>

                        @if(!$n->is_read)
                            <form action="{{ route('notifications.read', $n->id) }}" method="POST" class="mt-3">
                                @csrf
                                <button class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded transition">
                                    ✅ Marcar como leída
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-gray-600 py-16">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C8.67 6.165 7 8.388 7 11v3.159c0 .538-.214 1.055-.595 1.436L5 17h5m5 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <p class="mt-4 text-lg">No tienes notificaciones nuevas.</p>
            </div>
        @endforelse
    </div>
</x-app-layout>
