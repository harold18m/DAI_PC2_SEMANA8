<?php
// Incluimos el archivo de conexión
include('../conexion/conexion.php');

// Verificamos si se recibieron los datos del formulario
if (isset($_POST['editar'])) {

    // Obtenemos los valores del formulario
    $IdProducto = $_POST['IdProducto'];
    $Nombre = $_POST['Nombre'];
    $Descripcion = $_POST['Descripcion'];
    $Stock = $_POST['Stock'];
    $PrecioVenta = $_POST['PrecioVenta'];

    // Abrimos una conexión a la base de datos
    $conexion = conectar();

    // Actualizamos los datos del producto en la base de datos
    $query = $conexion->prepare("UPDATE producto SET Nombre = ?, Descripcion = ?, Stock = ?, PrecioVenta = ? WHERE IdProducto = ?");
    $query->bind_param('ssidi', $Nombre, $Descripcion, $Stock, $PrecioVenta, $IdProducto);
    $msg = '';
    if ($query->execute()) {
        $msg = 'Producto actualizado con éxito';
    } else {
        $msg = 'No se pudo actualizar al producto';
    }

    // Cerramos la conexión a la base de datos
    desconectar($conexion);

    // Redirigimos al listado de productos con un mensaje de éxito o error
    header('Location: productos.php?msg=' . urlencode($msg));
    exit();
}
// Si no se envió el formulario de edición, mostramos los datos actuales del producto
else {

    // Obtenemos el ID del producto a editar
    $IdProducto = $_POST['IdProducto'];

    // obtenemos los datos del producto para mostrar en el formulario
    $conexion = conectar();
    $query = $conexion->prepare("SELECT Nombre, Descripcion, Stock, PrecioVenta FROM producto WHERE IdProducto = ?");
    $query->bind_param('i', $IdProducto);
    $query->execute();
    $query->bind_result($Nombre, $Descripcion, $Stock, $PrecioVenta);
    $query->fetch();
    desconectar($conexion);
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.7/tailwind.min.css">
    <title>Editar producto</title>
</head>

<body class="bg-gray-100">
    <h1 class="text-center text-3xl font-bold pt-10">Editar producto</h1>
    <div class="max-w-lg mx-auto my-5 bg-white p-5 rounded-lg shadow-md">
        <form action="editar.php" method="post">
            <input type="hidden" name="IdProducto" value="<?php echo $IdProducto ?>">
            <div class="mb-4">
                <label for="Nombre" class="block text-gray-700 font-bold mb-2">Nombre del producto:</label>
                <input type="text" maxlength="80" name="Nombre" id="Nombre" value="<?php echo $Nombre ?>" required class="border rounded-lg px-3 py-2 w-full">
            </div>
            <div class="mb-4">
                <label for="Descripcion" class="block text-gray-700 font-bold mb-2">Descripción del producto:</label>
                <input type="text" name="Descripcion" maxlength="250" id="Descripcion" value="<?php echo $Descripcion ?>" class="border rounded-lg px-3 py-2 w-full">
            </div>
            <div class="mb-4">
                <label for="Stock" class="block text-gray-700 font-bold mb-2">Stock:</label>
                <input type="number" name="Stock" id="Stock" value="<?php echo $Stock ?>" required class="border rounded-lg px-3 py-2 w-full">
            </div>
            <div class="mb-4">
                <label for="PrecioVenta" class="block text-gray-700 font-bold mb-2">Precio de Venta:</label>
                <input type="number" class="border rounded-lg px-3 py-2 w-full" step="0.01" value="<?php echo $PrecioVenta ?>" name="PrecioVenta" id="PrecioVenta" required>
            </div>
            <div class="mb-4">
                <button type="submit" name="editar" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Actualizar</button>
            </div>
        </form>
        <div>
            <a href="autores.php" class="text-blue-500 hover:text-blue-700">Regresar</a>
        </div>
    </div>
</body>
</html>
