@extends('layouts.app')

@section('content')
    <h1>Editar Venta</h1>
    <form action="{{ route('ventas.update', $venta->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="cliente_id" value="{{ $venta->cliente_id }}">

        <div class="mb-3">
            <label for="cliente_id" class="form-label">Cliente</label>
            <select name="cliente_id" id="cliente_id" class="form-control" disabled>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ $venta->cliente_id == $cliente->id ? 'selected' : '' }}>{{ $cliente->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="producto_llevar" class="form-label">Producto</label>
            <select name="producto_llevar" id="producto_llevar" class="form-control" required>
                <option value="">Seleccione un producto</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}" data-precio="{{ $producto->precio }}" data-stock="{{ $producto->stock }}" {{ $venta->producto_id == $producto->id ? 'selected' : '' }}>{{ $producto->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="text" id="precio" class="form-control" readonly>
        </div>
        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad Anterior</label>
            <input type="number" name="cantidad_anterior" id="cantidad_anterior" class="form-control" value="{{ $venta->cantidad }}" readonly>
        </div>
        <div class="mb-3">
            <label for="nueva_cantidad" class="form-label">Nueva Cantidad</label>
            <input type="number" name="nueva_cantidad" id="nueva_cantidad" class="form-control" min="1" required>
            <span id="stock-disponible" class="text-muted"></span>
        </div>
        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="number" step="0.01" name="total" id="total" class="form-control" value="{{ $venta->total }}" required>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productoSelect = document.getElementById('producto_llevar');
            const precioInput = document.getElementById('precio');
            const cantidadAnteriorInput = document.getElementById('cantidad_anterior');
            const nuevaCantidadInput = document.getElementById('nueva_cantidad');
            const totalInput = document.getElementById('total');
            const stockDisponible = document.getElementById('stock-disponible');

            productoSelect.addEventListener('change', function() {
                const selectedOption = productoSelect.options[productoSelect.selectedIndex];
                const precio = selectedOption.getAttribute('data-precio');
                const stock = selectedOption.getAttribute('data-stock');
                precioInput.value = precio ? parseFloat(precio).toFixed(2) : '';
                stockDisponible.textContent = stock ? 'Stock disponible: ' + stock : '';
            });

            nuevaCantidadInput.addEventListener('input', function() {
                const cantidadAnterior = parseFloat(cantidadAnteriorInput.value);
                const nuevaCantidad = parseFloat(nuevaCantidadInput.value);
                const stock = parseFloat(stockDisponible.textContent.replace('Stock disponible: ', ''));
                const stockDisponibleDespues = stock + nuevaCantidad - cantidadAnterior;
                stockDisponible.textContent = 'Stock disponible: ' + stockDisponibleDespues;
            });

            // Llamar al evento change del select al cargar la página
            productoSelect.dispatchEvent(new Event('change'));
        });
    </script>
@endsection
