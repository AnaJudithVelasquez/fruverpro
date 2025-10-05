<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Producto;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CompraController extends Controller
{
    public function index(Request $request)
{
    $buscar = $request->input('buscar');

    $compras = Compra::with('producto')
        ->when($buscar, function ($query, $buscar) {
            $query->whereHas('producto', function ($q) use ($buscar) {
                $q->where('nombre', 'like', "%{$buscar}%");
            });
        })
        ->orderBy('fecha', 'desc')
        ->get();

    return view('compras.index', compact('compras'));
}




    public function create()
    {
        $productos = Producto::all();
        return view('compras.create', compact('productos'));
    }

   public function store(Request $request)
{
    $request->validate([
        'fecha' => 'required|date',
        'producto' => 'required|string|max:255', // Texto ingresado
        'proveedor' => 'required|string|max:255',
        'cantidad' => 'required|integer|min:1',
        'costo_unitario' => 'required|numeric|min:0',
        'costo_total' => 'required|numeric|min:0',
    ]);

    // Buscar o crear producto
    $producto = Producto::firstOrCreate(
        ['nombre' => $request->producto],
        [
            'categoria' => 'Sin categoría', // Puedes cambiarlo dinámicamente
            'precio' => $request->costo_unitario,
            'stock' => 0
        ]
    );

    // Actualizar stock y precio del producto
    $producto->stock += $request->cantidad;
    $producto->precio = $request->costo_unitario; // opcional
    $producto->save();

    // Crear compra con producto_id
    Compra::create([
        'fecha' => $request->fecha,
        'producto_id' => $producto->id,
        'proveedor' => $request->proveedor,
        'cantidad' => $request->cantidad,
        'costo_unitario' => $request->costo_unitario,
        'costo_total' => $request->costo_total,
    ]);

    return redirect()->route('compras.index')->with('success', 'Compra registrada correctamente.');
}



    public function edit(Compra $compra)
    {
        $productos = Producto::all();
        return view('compras.edit', compact('compra', 'productos'));
    }

    public function update(Request $request, Compra $compra)
    {
        $request->validate([
            'fecha' => 'required|date',
            'producto_id' => 'required|exists:productos,id',
            'proveedor' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:1',
            'costo_unitario' => 'required|numeric|min:0',
        ]);

        $compra->update([
            'fecha' => $request->fecha,
            'producto_id' => $request->producto_id,
            'proveedor' => $request->proveedor,
            'cantidad' => $request->cantidad,
            'costo_unitario' => $request->costo_unitario,
            'costo_total' => $request->cantidad * $request->costo_unitario,
        ]);

        return redirect()->route('compras.index')->with('success', 'Compra actualizada correctamente.');
    }

    public function destroy(Compra $compra)
    {
        $compra->delete();
        return redirect()->route('compras.index')->with('success', 'Compra eliminada correctamente.');
    }

    public function generarPDF()
    {
        $compras = Compra::with('producto')->get();
        $pdf = Pdf::loadView('compras.pdf', compact('compras'));
        return $pdf->download('compras.pdf');
    }
}
