<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fuente bonita -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Archivos compilados por Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-100 text-gray-800">

    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="text-center space-y-6">

            <!-- Título principal -->
            <h1 class="text-5xl font-extrabold text-blue-600">
                Bienvenido a {{ config('app.name', 'Mi Proyecto Laravel') }}
            </h1>

            <!-- Subtítulo -->
            <p class="text-lg text-gray-600">
                Este es un ejemplo de página con Tailwind CSS funcionando correctamente.
            </p>

            <!-- Mostrar usuario autenticado -->
            @if (Auth::check())
                <p class="text-green-600 font-semibold">
                    Hola, {{ Auth::user()->name }} 👋
                </p>
                <a href="{{ route('logout') }}" 
                   class="inline-block bg-red-500 text-white px-5 py-2 rounded-lg hover:bg-red-600 transition">
                    Cerrar sesión
                </a>
            @else
                <div class="space-x-4">
                    <a href="{{ route('login') }}" 
                       class="bg-blue-500 text-white px-5 py-2 rounded-lg hover:bg-blue-600 transition">
                        Iniciar sesión
                    </a>
                    <a href="{{ route('register') }}" 
                       class="bg-green-500 text-white px-5 py-2 rounded-lg hover:bg-green-600 transition">
                        Registrarse
                    </a>
                </div>
            @endif

            <!-- Pie de página -->
            <footer class="pt-10 text-gray-500 text-sm">
                &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }} — Todos los derechos reservados.
            </footer>
        </div>
    </div>

</body>
</html>
