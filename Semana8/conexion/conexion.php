<?php

function conectar(){
    $conexion = mysqli_connect('localhost','root','usbw','lab08');
    return $conexion;
}

function desconectar($conexion){
    mysqli_close($conexion);
}

?>