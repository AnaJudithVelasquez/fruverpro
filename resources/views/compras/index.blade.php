<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🧾 Gestión de Compras
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- 🔹 Formulario para registrar una compra --}}
            <div class="bg-white p-6 rounded-2xl shadow">
                <h3 class="text-lg font-semibold mb-4">Registrar Nueva Compra</h3>

                <form action="{{ route('compras.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @csrf
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-1">Fecha</label>
                        <input type="date" name="fecha" required class="w-full rounded-lg border-gray-300 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-1">Producto</label>
                        <input type="text" name="producto" required class="w-full rounded-lg border-gray-300 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-1">Proveedor</label>
                        <input type="text" name="proveedor" required class="w-full rounded-lg border-gray-300 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-1">Cantidad</label>
                        <input type="number" name="cantidad" min="1" required class="w-full rounded-lg border-gray-300 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-1">Costo Unitario</label>
                        <input type="number" step="0.01" name="costo_unitario" required class="w-full rounded-lg border-gray-300 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-1">Costo Total</label>
                        <input type="number" step="0.01" name="costo_total" readonly class="w-full bg-gray-100 rounded-lg border-gray-300 shadow-sm">
                    </div>

                    <div class="md:col-span-3 flex justify-end mt-4">
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            💾 Registrar Compra
                        </button>
                    </div>
                </form>
            </div>

            {{-- 🔹 Tabla de compras --}}
            <div class="bg-white p-6 rounded-2xl shadow">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Listado de Compras</h3>

                    <div class="flex gap-2">
                        <form method="GET" action="{{ route('compras.index') }}" class="flex gap-2">
                            <input type="text" name="buscar" placeholder="Buscar producto..." 
                                value="{{ request('buscar') }}"
                                class="border rounded-lg px-3 py-1 shadow-sm">
                            <button class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600">
                                🔍 Buscar
                            </button>
                        </form>

                        <a href="{{ route('compras.pdf') }}" class="bg-red-600 text-white px-3 py-1 rounded-lg hover:bg-red-700">
                            🧾 Generar PDF
                        </a>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300 rounded-lg">
                        <thead class="bg-gray-200 text-gray-700">
                            <tr>
                                <th class="px-4 py-2 border">ID</th>
                                <th class="px-4 py-2 border">Fecha</th>
                                <th class="px-4 py-2 border">Producto</th>
                                <th class="px-4 py-2 border">Proveedor</th>
                                <th class="px-4 py-2 border">Cantidad</th>
                                <th class="px-4 py-2 border">Costo Unitario</th>
                                <th class="px-4 py-2 border">Costo Total</th>
                                <th class="px-4 py-2 border">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($compras as $compra)
                                <tr class="hover:bg-gray-100">
                                    <td class="px-4 py-2 border text-center">{{ $compra->id }}</td>
                                    <td class="px-4 py-2 border">{{ $compra->fecha }}</td>
                                    <td class="px-4 py-2 border">
                                        {{ $compra->producto->nombre ?? 'Sin producto' }}
                                    </td>
                                    <td class="px-4 py-2 border">{{ $compra->proveedor }}</td>
                                    <td class="px-4 py-2 border text-center">{{ $compra->cantidad }}</td>
                                    <td class="px-4 py-2 border text-right">${{ number_format($compra->costo_unitario, 2) }}</td>
                                    <td class="px-4 py-2 border text-right">${{ number_format($compra->costo_total, 2) }}</td>
                                    <td class="px-4 py-2 border text-center">
                                        <a href="{{ route('compras.edit', $compra->id) }}" class="text-blue-600 hover:underline">✏️</a>
                                        <form action="{{ route('compras.destroy', $compra->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('¿Eliminar esta compra?')">🗑️</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-gray-500">No hay compras registradas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.querySelector('input[name="costo_unitario"]').addEventListener('input', calcularTotal);
    document.querySelector('input[name="cantidad"]').addEventListener('input', calcularTotal);

    function calcularTotal() {
        const cantidad = parseFloat(document.querySelector('input[name="cantidad"]').value) || 0;
        const unitario = parseFloat(document.querySelector('input[name="costo_unitario"]').value) || 0;
        document.querySelector('input[name="costo_total"]').value = (cantidad * unitario).toFixed(2);
    }
</script>
