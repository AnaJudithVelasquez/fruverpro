<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ✏️ Editar Compra #{{ $compra->id }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Formulario --}}
            <div class="bg-white p-6 rounded-2xl shadow">
                <h3 class="text-lg font-semibold mb-6">Editar Compra</h3>

                <form action="{{ route('compras.update', $compra) }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @csrf
                    @method('PUT')

                    {{-- Fecha --}}
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-1">Fecha</label>
                        <input type="date" name="fecha" value="{{ old('fecha', $compra->fecha) }}" required
                               class="w-full rounded-lg border-gray-300 shadow-sm">
                    </div>

                    {{-- Producto (texto editable) --}}
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-1">Producto</label>
                        <input type="text" name="producto" value="{{ old('producto', $compra->producto->nombre ?? '') }}" required
                               class="w-full rounded-lg border-gray-300 shadow-sm">
                    </div>

                    {{-- Proveedor --}}
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-1">Proveedor</label>
                        <input type="text" name="proveedor" value="{{ old('proveedor', $compra->proveedor) }}" required
                               class="w-full rounded-lg border-gray-300 shadow-sm">
                    </div>

                    {{-- Cantidad --}}
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-1">Cantidad</label>
                        <input type="number" name="cantidad" min="1" value="{{ old('cantidad', $compra->cantidad) }}" required
                               class="w-full rounded-lg border-gray-300 shadow-sm">
                    </div>

                    {{-- Costo Unitario --}}
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-1">Costo Unitario</label>
                        <input type="number" step="0.01" name="costo_unitario" value="{{ old('costo_unitario', $compra->costo_unitario) }}" required
                               class="w-full rounded-lg border-gray-300 shadow-sm">
                    </div>

                    {{-- Costo Total --}}
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-1">Costo Total</label>
                        <input type="number" step="0.01" name="costo_total" value="{{ old('costo_total', $compra->costo_total) }}" readonly
                               class="w-full bg-gray-100 rounded-lg border-gray-300 shadow-sm">
                    </div>

                    {{-- Botones --}}
                    <div class="md:col-span-3 flex justify-end gap-2 mt-4">
                        <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                            💾 Guardar Cambios
                        </button>
                        <a href="{{ route('compras.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400">
                            🔙 Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.querySelector('input[name="costo_unitario"]').addEventListener('input', calcularTotal);
        document.querySelector('input[name="cantidad"]').addEventListener('input', calcularTotal);

        function calcularTotal() {
            const cantidad = parseFloat(document.querySelector('input[name="cantidad"]').value) || 0;
            const unitario = parseFloat(document.querySelector('input[name="costo_unitario"]').value) || 0;
            document.querySelector('input[name="costo_total"]').value = (cantidad * unitario).toFixed(2);
        }
    </script>
</x-app-layout>
