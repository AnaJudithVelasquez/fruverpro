@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3 text-success">➕ Registrar Compra</h2>

    <form action="{{ route('compras.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <label class="form-label">Fecha</label>
            <input type="date" name="fecha" class="form-control" value="{{ old('fecha', date('Y-m-d')) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Producto</label>
            <input list="productos" name="producto" class="form-control" placeholder="Selecciona o escribe un producto" required>
            <datalist id="productos">
                @foreach($productos as $p)
                    <option value="{{ $p->nombre }}">
                @endforeach
            </datalist>
        </div>

        <div class="mb-3">
            <label class="form-label">Proveedor</label>
            <input type="text" name="proveedor" class="form-control" required>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Cantidad</label>
                <input type="number" name="cantidad" class="form-control" required min="1">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Costo Unitario</label>
                <input type="number" step="0.01" name="costo_unitario" class="form-control" required min="0">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Costo Total</label>
                <input type="text" id="costo_total" class="form-control" readonly>
            </div>
        </div>

        <div class="text-center">
            <button class="btn btn-success">Guardar</button>
            <a href="{{ route('compras.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<script>
document.querySelector('input[name="cantidad"]').addEventListener('input', calcularTotal);
document.querySelector('input[name="costo_unitario"]').addEventListener('input', calcularTotal);

function calcularTotal() {
    const cantidad = parseFloat(document.querySelector('input[name="cantidad"]').value) || 0;
    const costo = parseFloat(document.querySelector('input[name="costo_unitario"]').value) || 0;
    document.getElementById('costo_total').value = (cantidad * costo).toFixed(2);
}
</script>
@endsection
