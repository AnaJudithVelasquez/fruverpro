@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-4">
    <div class="card bg-white shadow rounded p-6">
        <h3 class="text-xl font-bold mb-4">Detalles de la Venta #{{ $venta->id }}</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p><strong>Fecha:</strong> {{ $venta->fecha }}</p>
                <p><strong>Cliente:</strong> {{ $venta->cliente }}</p>
            </div>
            <div>
                <p><strong>Total Venta:</strong> ${{ number_format($venta->total_venta, 2) }}</p>
            </div>
        </div>

        <h4 class="mt-6 font-semibold">Productos</h4>
        <table class="table-auto w-full border border-gray-300 mt-2">
            <thead class="bg-green-100">
                <tr>
                    <th class="border px-2 py-1">Producto</th>
                    <th class="border px-2 py-1">Cantidad</th>
                    <th class="border px-2 py-1">Precio Unitario</th>
                    <th class="border px-2 py-1">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($venta->productos as $producto)
                <tr>
                    <td class="border px-2 py-1">{{ $producto->nombre }}</td>
                    <td class="border px-2 py-1">{{ $producto->pivot->cantidad }}</td>
                    <td class="border px-2 py-1">${{ number_format($producto->pivot->precio_unitario, 2) }}</td>
                    <td class="border px-2 py-1">${{ number_format($producto->pivot->subtotal, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4 flex gap-2">
            <a href="{{ route('ventas.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Volver</a>
            <a href="{{ route('ventas.pdf', $venta->id) }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Generar PDF</a>
        </div>
    </div>
</div>
@endsection
