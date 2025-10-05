<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Productos</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        th { background-color: #e0f2e9; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">🍏 Reporte de Productos - Fruver JJ</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->nombre }}</td>
                <td>{{ $p->categoria }}</td>
                <td>${{ number_format($p->precio, 2) }}</td>
                <td>{{ $p->stock }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
