<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura Venta #{{ $venta->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h2 { text-align: center; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        p { margin: 5px 0; }
    </style>
</head>
<body>
    <h2>Factura Venta #{{ $venta->id }}</h2>

    <p><strong>Fecha:</strong> {{ $venta->fecha }}</p>
    <p><strong>Cliente:</strong> {{ $venta->cliente }}</p>
    <p><strong>Total Venta:</strong> ${{ number_format($venta->total_venta, 2) }}</p>

    <h4>Productos</h4>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($venta->productos as $producto)
            <tr>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->pivot->cantidad }}</td>
                <td>${{ number_format($producto->pivot->precio_unitario, 2) }}</td>
                <td>${{ number_format($producto->pivot->subtotal, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
