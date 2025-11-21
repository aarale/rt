<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Crear Producto
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
        
        <form method="POST" action="{{ route('seller.products.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- Nombre --}}
            <div class="mb-4">
                <label class="block font-medium text-gray-700">Nombre</label>
                <input type="text" name="name" class="w-full mt-1 p-2 border rounded" required>
            </div>

            {{-- Slug --}}
            <div class="mb-4">
                <label class="block font-medium text-gray-700">Slug</label>
                <input type="text" name="slug" class="w-full mt-1 p-2 border rounded" required>
            </div>

            {{-- Descripción --}}
            <div class="mb-4">
                <label class="block font-medium text-gray-700">Descripción</label>
                <textarea name="description" class="w-full mt-1 p-2 border rounded"></textarea>
            </div>

            {{-- Precio --}}
            <div class="mb-4">
                <label class="block font-medium text-gray-700">Precio</label>
                <input type="number" name="price" step="0.01" class="w-full mt-1 p-2 border rounded" required>
            </div>

            {{-- Visible --}}
            <div class="mb-4">
                <label class="block font-medium text-gray-700">Visible</label>
                <input type="checkbox" name="visible" value="1">
            </div>
            <div class="mb-4">
    <label class="block font-medium text-gray-700">Stock inicial</label>
    <input type="number" name="stock" class="w-full p-2 border rounded" min="0" required>
</div>


            {{-- Business ID oculto --}}
            <input type="hidden" name="business_id" value="{{ auth()->user()->business->id }}">

            {{-- Botón guardar --}}
            <button class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                Guardar
            </button>

        </form>

    </div>

</x-app-layout>
