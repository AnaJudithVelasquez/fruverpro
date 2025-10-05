@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold text-green-700 mb-4">Registrar nuevo producto 🍏</h2>

<form action="{{ route('productos.store') }}" method="POST" class="bg-white p-6 rounded shadow-md max-w-lg mx-auto">
    @csrf
    <label>Nombre:</label>
    <input type="text" name="nombre" class="w-full border rounded p-2 mb-3" required>

    <label>Categoría:</label>
    <select name="categoria" class="border rounded p-2 w-full" required>
    <option value="">-- Selecciona una categoría --</option>
    <option value="Frutas">Frutas</option>
    <option value="Verduras">Verduras</option>
    <option value="Tubérculos">Tubérculos</option>
</select>

    <label>Precio:</label>
    <input type="number" name="precio" step="0.01" class="w-full border rounded p-2 mb-3" required>

    <label>Stock:</label>
    <input type="number" name="stock" class="w-full border rounded p-2 mb-3" required>

    <label>Descripción:</label>
    <textarea name="descripcion" class="w-full border rounded p-2 mb-3"></textarea>

    <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Guardar</button>
    <a href="{{ route('productos.index') }}" class="ml-3 text-gray-600 hover:text-gray-900">Cancelar</a>
</form>
@endsection
