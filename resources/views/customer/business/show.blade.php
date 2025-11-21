@extends('layouts.app')

@section('content')
<h2>{{ $business->name }}</h2>
<p>{{ $business->description }}</p>

<h4>Productos</h4>
@foreach($business->products as $product)
    <div>
        <strong>{{ $product->name }}</strong> - ${{ $product->price }} <br>
        <form method="POST" action="{{ route('cliente.carrito.agregar') }}">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="number" name="quantity" value="1" min="1" required>
            <button type="submit">Agregar al carrito</button>
        </form>
    </div>
@endforeach
@endsection
