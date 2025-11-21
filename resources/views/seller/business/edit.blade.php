@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 shadow rounded">

    <h1 class="text-2xl font-bold mb-4">Editar negocio</h1>

    <form action="{{ route('seller.business.update') }}" method="POST">
        @csrf
        @method('PUT')

        <label class="block mb-2">Nombre:</label>
        <input name="name" value="{{ $business->name }}" 
               class="w-full border p-2 rounded mb-3">

        <label class="block mb-2">Slug:</label>
        <input name="slug" value="{{ $business->slug }}" 
               class="w-full border p-2 rounded mb-3">

        <label class="block mb-2">Descripción:</label>
        <textarea name="description" 
                  class="w-full border p-2 rounded mb-4">{{ $business->description }}</textarea>

        <button class="bg-green-600 text-white px-4 py-2 rounded">
            Actualizar negocio
        </button>
    </form>

</div>
@endsection
