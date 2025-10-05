@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold text-green-700 mb-4">Gestión de Productos 🍏</h2>

@if(session('success'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="flex justify-between mb-4">
    <form action="{{ route('productos.index') }}" method="GET">
        <input type="text" name="buscar" value="{{ $buscar }}" placeholder="Buscar producto..."
               class="border rounded p-2">
        <button class="bg-green-600 text-white px-3 py-2 rounded hover:bg-green-700">Buscar</button>
    </form>

    <div>
        <a href="{{ route('productos.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Nuevo producto</a>
        <a href="{{ route('productos.pdf') }}" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Generar PDF</a>
    </div>
</div>

<table class="w-full bg-white rounded shadow">
    <thead class="bg-green-600 text-white">
        <tr>
            <th class="p-2">ID</th>
            <th class="p-2">Nombre</th>
            <th class="p-2">Categoría</th>
            <th class="p-2">Precio</th>
            <th class="p-2">Stock</th>
            <th class="p-2">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($productos as $producto)
        <tr class="border-t">
            <td class="p-2 text-center">{{ $producto->id }}</td>
            <td class="p-2">{{ $producto->nombre }}</td>
            <td class="p-2">{{ $producto->categoria }}</td>
            <td class="p-2">${{ number_format($producto->precio, 2) }}</td>
            <td class="p-2 text-center">{{ $producto->stock }}</td>
            <td class="p-2 text-center">
                <a href="{{ route('productos.edit', $producto) }}" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">Editar</a>
                <form action="{{ route('productos.destroy', $producto) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('¿Eliminar producto?')" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $productos->links() }}
</div>
@endsection
