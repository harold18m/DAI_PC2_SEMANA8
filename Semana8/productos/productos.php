<?php

include('../conexion/conexion.php');

// Abrimos la conexión a la BD
$conexion = conectar();

// Consulta a la BD con prepared statement
$query = $conexion->prepare("SELECT IdProducto, Nombre, Descripcion, Stock, PrecioVenta FROM producto");
$query->execute();
$resultado = $query->get_result();

// Cerramos la conexion
desconectar($conexion);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.7/tailwind.min.css" />
    <title>Productos</title>
</head>

<body>
    <nav class="bg-gray-900">
        <a class="text-white text-lg font-bold p-4" href="#">
            <h1>CRUD - Laboratorio 8</h1>
        </a>
    </nav>
    <h1 class="text-center p-3 text-2xl font-bold">CRUD - Productos</h1>
    <div class="p-4">
        <a href="./agregar.html" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Agregar producto
        </a>
    </div>
    <div class="container mx-auto p-4">
        <div class="w-full md:w-2/3 mx-auto">
            <table class="table-auto border-collapse w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2 bg-secondary text-gray-100 font-semibold text-sm">ID</th>
                        <th class="px-4 py-2 bg-secondary text-gray-100 font-semibold text-sm">Nombre</th>
                        <th class="px-4 py-2 bg-secondary text-gray-100 font-semibold text-sm">Descripción</th>
                        <th class="px-4 py-2 bg-secondary text-gray-100 font-semibold text-sm">Stock</th>
                        <th class="px-4 py-2 bg-secondary text-gray-100 font-semibold text-sm">Precio de venta</th>
                        <th class="px-4 py-2 bg-secondary text-gray-100 font-semibold text-sm"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Mostrar 
                    while ($producto = $resultado->fetch_assoc()) {
                        echo '<tr class="border-b border-gray-200 hover:bg-gray-100">';
                        echo '<td class="px-4 py-2">' . $producto['IdProducto'] . '</td>';
                        echo '<td class="px-4 py-2">' . $producto['Nombre'] . '</td>';
                        echo '<td class="px-4 py-2">' . $producto['Descripcion'] . '</td>';
                        echo '<td class="px-4 py-2">' . $producto['Stock'] . '</td>';
                        echo '<td class="px-4 py-2">' . $producto['PrecioVenta'] . '</td>';
                        echo '<td class="px-4 py-2">
                    <form action="./editar.php" method="post" class="inline-block">
                    <input type="hidden" name="IdProducto" value="' . $producto['IdProducto'] . '">
                    <input type="hidden" name="Nombre" value="' . $producto['Nombre'] . '">
                    <input type="hidden" name="Descripcion" value="' . $producto['Descripcion'] . '">
                    <input type="hidden" name="Stock" value="' . $producto['Stock'] . '">
                    <input type="hidden" name="PrecioVenta" value="' . $producto['PrecioVenta'] . '">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">Editar</button>
                    </form>
                    <form action="./eliminar.php" method="post" class="inline-block">
                    <input type="hidden" name="IdProducto" value="' . $producto['IdProducto'] . '">
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded">Eliminar</button>
                    </form>
                </td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!--Este formulario permite realizar una búsqueda de productos específicos, redirigiendo al archivo "consulta_de_productos.php" para procesar la búsqueda y encontrar aquellos productos que contienen el texto que se insertó en el campo de búsqueda. -->
    <form action="buscar_nombre.php" name="buscador" method="post" class="p-4">
        <h3 class="text-center text-gray-700 text-lg font-bold mb-4">Buscador de productos</h3>
        <div class="mb-4">
            <label for="" class="block text-gray-700 font-bold mb-2">Nombre del Producto</label>
            <input type="text" class="form-input border-2 border-gray-400 rounded-md py-2 px-4 w-full" name="Nombre"
                required>
        </div>
        <button type="submit" name="buscador" class="bg-gray-700 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded-md">
            Buscar
        </button>
    </form>
</body>

</html>