@extends('layouts.app')

@section('content')
    <h1>Crear Venta</h1>
    <form action="{{ route('ventas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="cliente_id" class="form-label">Cliente</label>
            <select name="cliente_id" id="cliente_id" class="form-control" required>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="producto_llevar" class="form-label">Producto</label>
            <select name="producto_llevar" id="producto_llevar" class="form-control" required>
                <option value="">Seleccione un producto</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}" data-precio="{{ $producto->precio }}" data-stock="{{ $producto->stock }}">{{ $producto->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="text" id="precio" class="form-control" readonly>
        </div>
        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control" min="1" required>
            <span id="stock-disponible" class="text-muted"></span>
        </div>
        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="number" step="0.01" name="total" id="total" class="form-control" readonly>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
 
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productoSelect = document.getElementById('producto_llevar');
            const precioInput = document.getElementById('precio');
            const cantidadInput = document.getElementById('cantidad');
            const totalInput = document.getElementById('total');
            const stockDisponible = document.getElementById('stock-disponible');

            productoSelect.addEventListener('change', function() {
                const selectedOption = productoSelect.options[productoSelect.selectedIndex];
                const precio = selectedOption.getAttribute('data-precio');
                const stock = selectedOption.getAttribute('data-stock');
                precioInput.value = precio ? parseFloat(precio).toFixed(2) : '';
                stockDisponible.textContent = stock ? 'Stock disponible: ' + stock : '';

                calcularTotal();
            });

            cantidadInput.addEventListener('input', function() {
                const selectedOption = productoSelect.options[productoSelect.selectedIndex];
                const stock = parseInt(selectedOption.getAttribute('data-stock'));
                if (cantidadInput.value > stock) {
                    alert("La cantidad seleccionada excede el stock disponible.");
                    cantidadInput.value = stock;
                }
                calcularTotal();
            });

            function calcularTotal() {
                const precio = parseFloat(precioInput.value);
                const cantidad = parseFloat(cantidadInput.value);
                const total = precio && cantidad ? precio * cantidad : 0;
                totalInput.value = total.toFixed(2);
            }
        });
    </script>
@endsection
