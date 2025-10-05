@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-4">
    <div class="card bg-white shadow rounded p-6">
        <h3 class="text-xl font-bold mb-4">Editar Venta</h3>

        <form action="{{ route('ventas.update', $venta->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="fecha" class="block font-medium">Fecha</label>
                    <input type="date" name="fecha" class="border rounded w-full p-2" value="{{ $venta->fecha }}" required>
                </div>
                <div>
                    <label for="cliente" class="block font-medium">Cliente</label>
                    <input type="text" name="cliente" class="border rounded w-full p-2" value="{{ $venta->cliente }}" required>
                </div>
            </div>

            <h4 class="mt-6 font-semibold">Productos</h4>
            <table class="table-auto w-full border border-gray-300 mt-2" id="productos_table">
                <thead class="bg-green-100">
                    <tr>
                        <th class="border px-2 py-1">Producto</th>
                        <th class="border px-2 py-1">Cantidad</th>
                        <th class="border px-2 py-1">Precio Unitario</th>
                        <th class="border px-2 py-1">Subtotal</th>
                        <th class="border px-2 py-1">
                            <button type="button" id="addProducto" class="bg-green-500 text-white px-2 py-1 rounded">+</button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($venta->productos as $index => $vp)
                    <tr>
                        <td>
                            <select name="productos[{{ $index }}][producto_id]" class="form-select producto-select border p-1 w-full" required>
                                <option value="">Seleccione...</option>
                                @foreach($productos as $producto)
                                    <option value="{{ $producto->id }}" data-precio="{{ $producto->precio }}" {{ $vp->id == $producto->id ? 'selected' : '' }}>
                                        {{ $producto->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="number" name="productos[{{ $index }}][cantidad]" class="cantidad border p-1 w-full" value="{{ $vp->pivot->cantidad }}" min="1"></td>
                        <td><input type="text" name="productos[{{ $index }}][precio_unitario]" class="precio_unitario border p-1 w-full" value="{{ $vp->pivot->precio_unitario }}" readonly></td>
                        <td><input type="text" name="productos[{{ $index }}][subtotal]" class="subtotal border p-1 w-full" value="{{ $vp->pivot->subtotal }}" readonly></td>
                        <td><button type="button" class="removeProducto bg-red-500 text-white px-2 py-1 rounded">-</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4 flex justify-end">
                <div class="w-1/3">
                    <label for="total_venta" class="block font-medium">Total Venta</label>
                    <input type="text" name="total_venta" id="total_venta" class="border rounded w-full p-2" value="{{ $venta->total_venta }}" readonly>
                </div>
            </div>

            <div class="mt-6 flex gap-2">
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Actualizar Venta</button>
                <a href="{{ route('ventas.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let index = {{ $venta->productos->count() }};

    function calcularSubtotal(row) {
        const cantidad = parseFloat(row.querySelector('.cantidad').value || 0);
        const precio = parseFloat(row.querySelector('.precio_unitario').value || 0);
        row.querySelector('.subtotal').value = (cantidad * precio).toFixed(2);
        calcularTotal();
    }

    function calcularTotal() {
        let total = 0;
        document.querySelectorAll('.subtotal').forEach(input => {
            total += parseFloat(input.value) || 0;
        });
        document.getElementById('total_venta').value = total.toFixed(2);
    }

    document.getElementById('addProducto').addEventListener('click', function () {
        let row = document.querySelector('#productos_table tbody tr').cloneNode(true);
        row.querySelectorAll('input').forEach(input => input.value = '');
        row.querySelector('select').value = '';
        row.querySelector('select').name = `productos[${index}][producto_id]`;
        row.querySelector('.cantidad').name = `productos[${index}][cantidad]`;
        row.querySelector('.precio_unitario').name = `productos[${index}][precio_unitario]`;
        row.querySelector('.subtotal').name = `productos[${index}][subtotal]`;
        row.querySelector('.cantidad').value = 1;
        document.querySelector('#productos_table tbody').appendChild(row);
        index++;
    });

    document.addEventListener('change', function (e) {
        if (e.target.matches('.cantidad')) {
            calcularSubtotal(e.target.closest('tr'));
        }
        if (e.target.matches('.producto-select')) {
            let precio = e.target.selectedOptions[0].dataset.precio || 0;
            let row = e.target.closest('tr');
            row.querySelector('.precio_unitario').value = precio;
            calcularSubtotal(row);
        }
    });

    document.addEventListener('click', function (e) {
        if (e.target.matches('.removeProducto')) {
            if (document.querySelectorAll('#productos_table tbody tr').length > 1) {
                e.target.closest('tr').remove();
                calcularTotal();
            }
        }
    });
});
</script>
@endsection
