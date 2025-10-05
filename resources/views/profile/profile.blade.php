@extends('layouts.plantilla')

@section('titulo', 'Perfil de Usuario')

@section('contenido')
<div class="max-w-lg mx-auto bg-white p-6 rounded-xl shadow">
    <h2 class="text-2xl font-bold text-green-700 mb-4 text-center">Perfil de Usuario</h2>

    <div class="space-y-4">
        <p><span class="font-semibold text-gray-700">Nombre:</span> {{ Auth::user()->name ?? 'Administrador' }}</p>
        <p><span class="font-semibold text-gray-700">Correo:</span> {{ Auth::user()->email ?? 'admin@fruver.com' }}</p>
    </div>

    <div class="text-center mt-6">
        <a href="{{ route('dashboard') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            ⬅ Volver al Dashboard
        </a>
    </div>
</div>
@endsection
