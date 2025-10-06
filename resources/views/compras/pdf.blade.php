<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Compras</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        th { background-color: #d7f3e3; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">🧾 Reporte de Compras - Fruver JJ</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Producto</th>
                <th>Proveedor</th>
                <th>Cantidad</th>
                <th>Costo Unitario</th>
                <th>Costo Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($compras as $c)
            <tr>
                <td>{{ $c->id }}</td>
                <td>{{ $c->fecha }}</td>
                <td>{{ $c->producto->nombre ?? 'N/A' }}</td>
                <td>{{ $c->proveedor }}</td>
                <td>{{ $c->cantidad }}</td>
                <td>${{ number_format($c->costo_unitario, 2) }}</td>
                <td>${{ number_format($c->costo_total, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
