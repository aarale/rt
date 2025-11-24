@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded-xl shadow-lg">
    <h1 class="text-3xl font-extrabold text-gray-800 mb-6 text-center">🏪 Crear mi negocio</h1>

    <form action="{{ route('seller.business.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Nombre del negocio -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre del negocio</label>
            <input type="text" name="name" id="name"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                   required>
        </div>

        <!-- Slug -->
        <div>
            <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
            <input type="text" name="slug" id="slug"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                   required>
        </div>

        <!-- Descripción -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
            <textarea name="description" id="description" rows="4"
                      class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                      placeholder="Describe tu negocio aquí..."></textarea>
        </div>

        <!-- Botón -->
        <div class="text-center">
            <button type="submit"
                    class="bg-sky-600 hover:bg-sky-700 text-white font-semibold px-6 py-2 rounded-full transition">
                🚀 Crear negocio
            </button>
        </div>
    </form>
</div>
@endsection
