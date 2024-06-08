<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Models\Producto;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('cliente', 'producto')->get();
        return view('ventas.index', compact('ventas'));
    }
    

    public function create()
    {
        $clientes = Cliente::all();
        $productos = Producto::all(); 
        return view('ventas.create', ['clientes' => $clientes, 'productos' => $productos]);
    }

     
    public function store(Request $request)
    {
        $venta = new Venta();
        $producto = Producto::findOrFail($request->producto_llevar);
        $venta->cliente_id = $request->cliente_id;
        $venta->producto_id = $request->producto_llevar; 
        $venta->cantidad = $request->cantidad;
        $venta->total = $request->total;
    
        // Actualizar el stock del producto
        $producto->stock -= $request->cantidad;
        $producto->save();
    
        $venta->save();
    
        return redirect()->route('ventas.index');
    }
    

    public function show($id)
    {
        $venta = Venta::with('cliente')->findOrFail($id);
        return view('ventas.show', compact('venta'));
    }

public function edit($id)
{
    $venta = Venta::findOrFail($id);
    $clientes = Cliente::all();
    $productos = Producto::all();
    return view('ventas.edit', compact('venta', 'clientes', 'productos'));
}

public function update(Request $request, $id)
{
    $venta = Venta::findOrFail($id);
    $productoAnterior = Producto::findOrFail($venta->producto_id);
    $nuevoProducto = Producto::findOrFail($request->producto_llevar);

    $productoAnterior->stock += $venta->cantidad;
    $productoAnterior->save();
    $nuevaCantidad = $request->nueva_cantidad;
    $diferencia = $venta->cantidad - $nuevaCantidad;

    if ($diferencia > 0) {
        $nuevoProducto->stock += $diferencia;
    } elseif ($diferencia < 0) {
        $stockDisponible = $nuevoProducto->stock - abs($diferencia);
        if ($stockDisponible < 0) {
            return redirect()->back()->with('error', 'La cantidad ingresada supera el stock disponible.');
        }
        $nuevoProducto->stock -= abs($diferencia);
    }

    $nuevoProducto->save();

    $venta->cliente_id = $request->cliente_id;
    $venta->producto_id = $request->producto_llevar;
    $venta->cantidad = $nuevaCantidad;
    $venta->total = $request->total;
    $venta->save();

    return redirect()->route('ventas.index');
}

    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);
        $venta->delete();

        return redirect()->route('ventas.index');
    }
}
