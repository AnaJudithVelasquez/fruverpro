<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fruver JJ</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-green-50 font-sans antialiased">

    <!-- Navbar -->
    <nav class="bg-green-600 text-white p-4 flex justify-between items-center shadow">
        <h1 class="text-2xl font-bold">🍏 Fruver JJ</h1>
        <div>
            <a href="{{ route('dashboard') }}" class="px-3 hover:underline">Inicio</a>
            <a href="{{ route('profile.edit') }}" class="px-3 hover:underline">Perfil</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="px-3 hover:underline">Cerrar sesión</button>
            </form>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="p-6">
        @yield('content')
    </main>

</body>
</html>
