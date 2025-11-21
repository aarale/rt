@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 shadow rounded">

    <h1 class="text-2xl font-bold mb-4">Crear mi negocio</h1>

    <form action="{{ route('seller.business.store') }}" method="POST">
        @csrf

        <label class="block mb-2">Nombre del negocio:</label>
        <input name="name" class="w-full border p-2 rounded mb-3" required>

        <label class="block mb-2">Slug:</label>
        <input name="slug" class="w-full border p-2 rounded mb-3" required>

        <label class="block mb-2">Descripción:</label>
        <textarea name="description" class="w-full border p-2 rounded mb-4"></textarea>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Crear negocio
        </button>
    </form>

</div>
@endsection
