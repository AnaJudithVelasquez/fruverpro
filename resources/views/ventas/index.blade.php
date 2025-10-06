@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-4">
    <div class="card bg-white shadow rounded p-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold">Listado de Ventas</h3>
            <a href="{{ route('ventas.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Nueva Venta</a>
        </div>
        <table class="table-auto w-full border border-gray-300">
            <thead class="bg-green-100">
                <tr>
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Fecha</th>
                    <th class="border px-4 py-2">Cliente</th>
                    <th class="border px-4 py-2">Total</th>
                    <th class="border px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $venta)
                <tr>
                    <td class="border px-4 py-2">{{ $venta->id }}</td>
                    <td class="border px-4 py-2">{{ $venta->fecha }}</td>
                    <td class="border px-4 py-2">{{ $venta->cliente }}</td>
                    <td class="border px-4 py-2">${{ number_format($venta->total_venta, 2) }}</td>
                    <td class="border px-4 py-2 flex gap-2">
                        <a href="{{ route('ventas.show', $venta->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">Ver</a>
                        <a href="{{ route('ventas.edit', $venta->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">Editar</a>
                        <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Eliminar esta venta?')" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Eliminar</button>
                        </form>
                        <a href="{{ route('ventas.pdf', $venta->id) }}" class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600">PDF</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
