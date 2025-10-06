@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold text-green-700 mb-4">Editar producto 🍏</h2>

<form action="{{ route('productos.update', $producto) }}" method="POST" class="bg-white p-6 rounded shadow-md max-w-lg mx-auto">
    @csrf
    @method('PUT')

    <label>Nombre:</label>
    <input type="text" name="nombre" value="{{ $producto->nombre }}" class="w-full border rounded p-2 mb-3" required>

    <label>Categoría:</label>
   <select name="categoria" class="border rounded p-2 w-full" required>
    <option value="">-- Selecciona una categoría --</option>
    <option value="Frutas" {{ $producto->categoria == 'Frutas' ? 'selected' : '' }}>Frutas</option>
    <option value="Verduras" {{ $producto->categoria == 'Verduras' ? 'selected' : '' }}>Verduras</option>
    <option value="Tubérculos" {{ $producto->categoria == 'Tubérculos' ? 'selected' : '' }}>Tubérculos</option>
</select>

    <label>Precio:</label>
    <input type="number" name="precio" step="0.01" value="{{ $producto->precio }}" class="w-full border rounded p-2 mb-3" required>

    <label>Stock:</label>
    <input type="number" name="stock" value="{{ $producto->stock }}" class="w-full border rounded p-2 mb-3" required>

    <label>Descripción:</label>
    <textarea name="descripcion" class="w-full border rounded p-2 mb-3">{{ $producto->descripcion }}</textarea>

    <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Actualizar</button>
    <a href="{{ route('productos.index') }}" class="ml-3 text-gray-600 hover:text-gray-900">Cancelar</a>
</form>
@endsection
