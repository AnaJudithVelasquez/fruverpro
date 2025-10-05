@extends('layouts.plantilla')

@section('titulo', 'Panel de Control')

@section('contenido')
<div class="text-center mb-8">
    <h2 class="text-3xl font-bold text-green-700 mb-2">Panel de Control del Fruver</h2>
    <p class="text-gray-600">Administra las secciones principales de tu fruver</p>
</div>

<div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
    {{-- Productos --}}
    <div class="bg-white rounded-xl shadow-md hover:shadow-lg p-6 text-center transition transform hover:-translate-y-1">
        <div class="text-green-600 text-4xl mb-3">🥦</div>
        <h3 class="text-lg font-semibold mb-2 text-green-700">Productos</h3>
        <p class="text-gray-600 mb-4">Agrega o actualiza los productos disponibles.</p>
        <a href="#" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Ir</a>
    </div>

    {{-- Compras --}}
    <div class="bg-white rounded-xl shadow-md hover:shadow-lg p-6 text-center transition transform hover:-translate-y-1">
        <div class="text-green-600 text-4xl mb-3">🧾</div>
        <h3 class="text-lg font-semibold mb-2 text-green-700">Compras</h3>
        <p class="text-gray-600 mb-4">Registra las compras realizadas a proveedores.</p>
        <a href="#" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Ir</a>
    </div>

    {{-- Ventas --}}
    <div class="bg-white rounded-xl shadow-md hover:shadow-lg p-6 text-center transition transform hover:-translate-y-1">
        <div class="text-green-600 text-4xl mb-3">💰</div>
        <h3 class="text-lg font-semibold mb-2 text-green-700">Ventas</h3>
        <p class="text-gray-600 mb-4">Consulta y gestiona las ventas del fruver.</p>
        <a href="#" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Ir</a>
    </div>
</div>
@endsection
