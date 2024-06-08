@extends('layouts.app')

@section('content')
    <h1>Detalle de la Venta</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Venta #{{ $venta->id }}</h5>
            <p class="card-text"><strong>Cliente:</strong> {{ $venta->cliente->nombre }}</p>
            <p class="card-text"><strong>Producto:</strong> {{ $venta->producto->nombre }}</p> 
            <p class="card-text"><strong>Producto:</strong> {{ $venta->producto->precio }}</p> 
            <p class="card-text"><strong>Cantidad:</strong> {{ $venta->cantidad }}</p>
            <p class="card-text"><strong>Total:</strong> ${{ $venta->total }}</p>
            <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
@endsection
