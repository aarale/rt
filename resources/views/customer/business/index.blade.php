@extends('layouts.app')

@section('content')
<h2>Negocios Disponibles</h2>
@foreach($businesses as $business)
    <div>
        <h3><a href="{{ route('cliente.negocios.show', $business->slug) }}">{{ $business->name }}</a></h3>
        <p>{{ $business->description }}</p>
    </div>
@endforeach
@endsection
