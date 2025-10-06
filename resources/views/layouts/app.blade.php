<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fruver JJ</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-green-50 font-sans antialiased min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-green-600 text-white p-4 flex justify-between items-center shadow-md">
        <h1 class="text-2xl font-bold tracking-wide flex items-center gap-2">
            🍏 <span>Fruver JJ</span>
        </h1>

        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="hover:bg-green-700 px-3 py-2 rounded-md transition">
                Inicio
            </a>
            <a href="{{ route('productos.index') }}" class="hover:bg-green-700 px-3 py-2 rounded-md transition">Productos</a>
            <a href="{{ route('compras.index') }}" class="hover:bg-green-700 px-3 py-2 rounded-md transition">Compras</a>
            <a href="{{ route('ventas.index') }}" class="hover:bg-green-700 px-3 py-2 rounded-md transition">Ventas</a>
            <a href="{{ route('profile.edit') }}" class="hover:bg-green-700 px-3 py-2 rounded-md transition">Perfil</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="hover:bg-green-700 px-3 py-2 rounded-md transition">Cerrar sesión</button>
            </form>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="flex-1 p-6">
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-green-700 text-white text-center py-3 mt-auto">
        <p class="text-sm">&copy; {{ date('Y') }} Fruver JJ | Todos los derechos reservados 🍉</p>
    </footer>

</body>
</html>
