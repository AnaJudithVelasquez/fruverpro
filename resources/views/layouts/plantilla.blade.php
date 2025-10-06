<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'FruverApp')</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen flex">

        {{-- SIDEBAR --}}
        <aside class="w-64 bg-green-700 text-white flex flex-col justify-between shadow-lg">
            <div>
                <div class="text-center py-6 border-b border-green-500">
                    <h1 class="text-2xl font-bold tracking-wide">🍎 FruverApp</h1>
                </div>

                <nav class="mt-6 flex flex-col space-y-2 px-4">
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded hover:bg-green-600 transition @if(Route::is('dashboard')) bg-green-600 @endif">
                        🏠 Inicio
                    </a>
                    <a href="#" class="px-4 py-2 rounded hover:bg-green-600 transition">
                        🥬 Productos
                    </a>
                    <a href="#" class="px-4 py-2 rounded hover:bg-green-600 transition">
                        🧾 Compras
                    </a>
                    <a href="#" class="px-4 py-2 rounded hover:bg-green-600 transition">
                        💰 Ventas
                    </a>
                    <a href="{{ route('profile.edit') }}" class="px-4 py-2 rounded hover:bg-green-600 transition">
                        👤 Perfil
                    </a>
                </nav>
            </div>

            {{-- Cerrar sesión --}}
            <div class="p-4 border-t border-green-500">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded transition">
                        🚪 Cerrar sesión
                    </button>
                </form>
            </div>
        </aside>

        {{-- CONTENIDO PRINCIPAL --}}
        <main class="flex-1 flex flex-col">
            {{-- Navbar superior --}}
            <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-green-700">@yield('titulo', 'FruverApp')</h2>
                <span class="text-gray-600">👋 Hola, <b>{{ Auth::user()->name ?? 'Administrador' }}</b></span>
            </header>

            {{-- Contenido dinámico --}}
            <section class="flex-1 p-8 bg-gray-50">
                @yield('contenido')
            </section>

            {{-- Footer --}}
            <footer class="text-center text-gray-500 text-sm py-4 border-t">
                © 2025 FruverApp — Todos los derechos reservados.
            </footer>
        </main>
    </div>
</body>
</html>
