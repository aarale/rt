@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-10">

    <h1 class="text-3xl font-bold text-gray-800 mb-6">Editar producto ✏️</h1>

    <div class="bg-white rounded-lg shadow p-6">

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <strong>Ups...</strong> Hubo algunos problemas con tu entrada.
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('seller.products.update', $product->id) }}" 
              method="POST" 
              enctype="multipart/form-data"
              class="space-y-6">
            
            @csrf
            @method('PUT')
            <input type="hidden" name="business_id" value="{{ auth()->user()->business->id }}">

<p class="text-gray-600 mb-4">
    Negocio: <strong>{{ auth()->user()->business->name }}</strong>
</p>

            <div>
                <label class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Slug</label>
                <input type="text" name="slug" value="{{ old('slug', $product->slug) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea name="description" rows="3"
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description', $product->description) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Precio</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            
            <div class="mb-4">
    <label class="block font-medium text-gray-700">Stock</label>
    <input type="number" name="stock" value="{{ $product->inventory->stock ?? 0 }}" min="0" class="w-full p-2 border rounded">
</div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Imagen actual</label>

                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="Imagen actual"
                         class="w-48 h-48 object-cover rounded shadow mb-3">
                @else
                    <p class="text-gray-500 italic">Sin imagen</p>
                @endif
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Reemplazar imagen</label>
                <input type="file" name="image"
                       class="mt-1 block w-full text-sm text-gray-700
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-md file:border-0 file:text-sm file:font-semibold
                              file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('seller.products.index') }}"
                   class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg shadow-sm">
                   Cancelar
                </a>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                    Guardar cambios
                </button>
            </div>

        </form>

    </div>
</div>
@endsection
