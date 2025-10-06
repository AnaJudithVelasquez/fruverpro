<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;
use PDF;

class VentaController extends Controller
{
    /**
     * Mostrar listado de ventas
     */
    public function index()
    {
        $ventas = Venta::with('productos')->orderBy('created_at', 'desc')->get();
        return view('ventas.index', compact('ventas'));
    }

    /**
     * Mostrar formulario para crear venta
     */
    public function create()
    {
        $productos = Producto::all();
        return view('ventas.create', compact('productos'));
    }

    /**
     * Guardar nueva venta
     */
    public function store(Request $request)
{
    $request->validate([
        'fecha' => 'required|date',
        'cliente' => 'required|string|max:255',
        'productos' => 'required|array|min:1',
    ]);

    $venta = Venta::create([
        'fecha' => $request->fecha,
        'cliente' => $request->cliente,
        'total_venta' => 0,
    ]);

    $total = 0;

    foreach ($request->productos as $item) {
        if (isset($item['producto_id']) && $item['cantidad'] > 0) {
            $producto = Producto::find($item['producto_id']);
            if ($producto) {

                // ✅ Validar stock suficiente
                if ($producto->stock < $item['cantidad']) {
                    return redirect()->back()->withErrors("No hay suficiente stock de {$producto->nombre}");
                }

                $subtotal = $producto->precio * $item['cantidad'];

                // Restar stock
                $producto->stock -= $item['cantidad'];
                $producto->save();

                $venta->productos()->attach($producto->id, [
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $producto->precio,
                    'subtotal' => $subtotal
                ]);

                $total += $subtotal;
            }
        }
    }

    $venta->update(['total_venta' => $total]);

    return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente.');
}


    /**
     * Mostrar detalles de una venta
     */
    public function show(Venta $venta)
    {
        $venta->load('productos');
        return view('ventas.show', compact('venta'));
    }

    /**
     * Mostrar formulario para editar venta
     */
    public function edit(Venta $venta)
    {
        $productos = Producto::all();
        $venta->load('productos');
        return view('ventas.edit', compact('venta', 'productos'));
    }

    /**
     * Actualizar venta
     */
   public function update(Request $request, Venta $venta)
{
    $request->validate([
        'fecha' => 'required|date',
        'cliente' => 'required|string|max:255',
        'productos' => 'required|array|min:1',
    ]);

    // 1️⃣ Devolver el stock anterior
    foreach ($venta->productos as $vp) {
        $producto = Producto::find($vp->id);
        if ($producto) {
            $producto->stock += $vp->pivot->cantidad;
            $producto->save();
        }
    }

    // 2️⃣ Actualizar datos de la venta
    $venta->update([
        'fecha' => $request->fecha,
        'cliente' => $request->cliente,
        'total_venta' => 0,
    ]);

    $venta->productos()->detach();

    $total = 0;

    // 3️⃣ Aplicar nueva venta y descontar stock
    foreach ($request->productos as $item) {
        if (isset($item['producto_id']) && $item['cantidad'] > 0) {
            $producto = Producto::find($item['producto_id']);
            if ($producto) {

                // ✅ Validar stock suficiente
                if ($producto->stock < $item['cantidad']) {
                    return redirect()->back()->withErrors("No hay suficiente stock de {$producto->nombre}");
                }

                $subtotal = $producto->precio * $item['cantidad'];

                // Descontar stock
                $producto->stock -= $item['cantidad'];
                $producto->save();

                $venta->productos()->attach($producto->id, [
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $producto->precio,
                    'subtotal' => $subtotal
                ]);

                $total += $subtotal;
            }
        }
    }

    $venta->update(['total_venta' => $total]);

    return redirect()->route('ventas.index')->with('success', 'Venta actualizada correctamente.');
}


    /**
     * Eliminar venta
     */
    public function destroy(Venta $venta)
    {
        $venta->productos()->detach();
        $venta->delete();

        return redirect()->route('ventas.index')->with('success', 'Venta eliminada correctamente.');
    }

    /**
     * Generar PDF de venta
     */
    public function generarPDF(Venta $venta)
    {
        $venta->load('productos');
        $pdf = PDF::loadView('ventas.pdf', compact('venta'));
        return $pdf->download("venta_{$venta->id}.pdf");
    }
}
