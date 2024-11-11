<?php
$servidor = "localhost";
$usuario = "root"; 
$password = ""; 
$base_de_datos = "portal"; 

// Crear la conexión
$conexion = mysqli_connect($servidor, $usuario, $password, $base_de_datos);


if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
} else {
    echo "";
}
?>
