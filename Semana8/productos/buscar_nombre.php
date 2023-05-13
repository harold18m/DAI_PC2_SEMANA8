<?php

include('../conexion/conexion.php');

// Abrimos la conexión a la BD
$conexion = conectar();

// Consulta a la BD
if (isset($_POST['buscador'])) {
    $nombre = $_POST['Nombre'];
    $query = $conexion->prepare("SELECT IdProducto, Nombre, Descripcion, Stock, PrecioVenta FROM producto WHERE Nombre LIKE '%$nombre%'");
} else {
    $query = $conexion->prepare("SELECT IdProducto, Nombre, Descripcion, Stock, PrecioVenta FROM producto");
}

$query->execute();
$resultado = $query->get_result();


// Cerramos la conexión
desconectar($conexion);

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.7/tailwind.min.css">
    <title>Productos</title>
</head>
<body class="bg-gray-100">
<div class="col-8 p-4 mx-auto">
    <table  class="table-auto w-full">
        <thead class="bg-secondary text-black">
            <tr>
            <th class="px-4 py-2">ID</th>
            <th class="px-4 py-2">Nombre</th>
            <th class="px-4 py-2">Descripcion</th>
            <th class="px-4 py-2">Stock</th>
            <th class="px-4 py-2">Precio de venta</th>
            <th class="px-4 py-2"></th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Mostrar el set de los registros que hay en la BD
            while($producto = $resultado->fetch_assoc()){
                echo '<tr>';
                echo '<td class="border px-4 py-2">'.$producto['IdProducto'].'</td>';
                echo '<td class="border px-4 py-2">'.$producto['Nombre'].'</td>';
                echo '<td class="border px-4 py-2">'.$producto['Descripcion'].'</td>';
                echo '<td class="border px-4 py-2">'.$producto['Stock'].'</td>';
                echo '<td class="border px-4 py-2">'.$producto['PrecioVenta'].'</td>';
                echo '</tr>';
            }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>