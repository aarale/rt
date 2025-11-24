@extends('layouts.seller')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-md mt-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6 flex items-center gap-2">
        📦 Crear nuevo producto
    </h2>

    <form method="POST" action="{{ route('seller.products.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Nombre --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-1">Nombre del producto</label>
            <input type="text" name="name" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
        </div>

        {{-- Slug --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-1">Slug</label>
            <input type="text" name="slug" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
        </div>

        {{-- Descripción --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-1">Descripción</label>
            <textarea name="description" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
        </div>

        {{-- Precio y Stock --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold text-gray-700 mb-1">Precio</label>
                <input type="number" name="price" step="0.01" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>
            <div>
                <label class="block font-semibold text-gray-700 mb-1">Stock inicial</label>
                <input type="number" name="stock" min="0" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>
        </div>

        {{-- Categorías --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-1">Categorías</label>
            <select name="category_ids[]" multiple class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <small class="text-gray-500">Puedes seleccionar más de una categoría.</small>
        </div>

        {{-- Imagen --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-1">Imagen del producto</label>
            <input type="file" name="image" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                file:rounded-full file:border-0 file:text-sm file:font-semibold
                file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
            <small class="text-gray-500">Formatos permitidos: JPG, PNG. Máximo 2MB.</small>
        </div>

        {{-- Visible --}}
        <div class="flex items-center gap-2">
            <input type="checkbox" name="visible" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
            <label class="text-gray-700">Visible para los clientes</label>
        </div>

        {{-- Business ID --}}
        <input type="hidden" name="business_id" value="{{ auth()->user()->business->id }}">

        {{-- Botón --}}
        <div class="pt-4">
            <button type="submit"
                class="w-full py-3 bg-indigo-600 text-white text-lg font-semibold rounded-lg hover:bg-indigo-700 transition">
                Guardar producto
            </button>
        </div>
    </form>
</div>
@endsection
