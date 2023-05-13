<?php

include('../conexion/conexion.php');

// Obtenemos los valores del formulario
$Nombre = $_POST['Nombre'];
$Descripcion = $_POST['Descripcion'];
$Stock = $_POST['Stock'];
$PrecioVenta = $_POST['PrecioVenta'];

// Abrimos la conexión a la base de datos
$conexion = conectar();

// Consulta a la base de datos
$query = $conexion->prepare("INSERT INTO Producto (Nombre, Descripcion, Stock, PrecioVenta) VALUES (?,?,?,?)");
$query->bind_param('ssid', $Nombre, $Descripcion, $Stock, $PrecioVenta); //match tipo de dato con el dato
$msg = '';
if ($query->execute()){
    $msg = 'Producto registrado';
}
else {
    $msg = 'No se pudo registrar el producto';
}
// Cerramos la conexión a la BD
desconectar($conexion);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso Producto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.7/tailwind.min.css">
</head>
<body class="bg-gray-100">
    <div class="max-w-xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Ingreso Producto</h1>
        <h3 class="text-xl mb-6"><?php echo $msg ?></h3>
        <a href="./productos.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Regresar
        </a>
    </div>
</body>
</html>
