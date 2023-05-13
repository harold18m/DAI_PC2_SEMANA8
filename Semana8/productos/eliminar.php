<?php
include('../conexion/conexion.php');

// Primero, verificamos si se recibió el ID del autor a eliminar
if (isset($_POST['IdProducto'])) {
    
    $conexion = conectar();

    // Preparamos la consulta SQL para eliminar el autor
    $consulta = 'DELETE FROM Producto WHERE IdProducto = ?';
    $sentencia = $conexion->prepare($consulta);
    $sentencia->bind_param('i', $_POST['IdProducto']);
    
    // Ejecutamos la consulta
    if ($sentencia->execute()) {
        // Si se eliminó el autor correctamente, redirigimos a la página de autores
        header('Location: ./productos/productos.php');
        exit;
    } else {
        // Si hubo un error al eliminar el autor, mostramos un mensaje
        echo 'Error al eliminar el producto';
    }
    
} else {
    // Si no se recibió el ID del autor a eliminar, mostramos un mensaje
    echo 'No se recibió el ID del producto a eliminar';
}
desconectar($conexion);
?>

