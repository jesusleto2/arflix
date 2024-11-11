<?php 
session_start();
require('controller/conexion.php'); // Ajusta la ruta según la estructura de tu proyecto

// Asegurarse de que $_SESSION['id_usuario'] y otros valores están disponibles
$id_usuario = $_SESSION['id_usuario'] ?? null;
$nombre_usuario = $_SESSION['nombre'] ?? 'Usuario';

// Comprobación mínima para obtener los datos del usuario
$sql = "SELECT nombre, foto_perfil FROM usuarios WHERE id = '$id_usuario'";
$resultado = $conexion->query($sql);

if ($resultado && $resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    $nombre_usuario = $fila['nombre'];
    $foto_perfil = $fila['foto_perfil'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Perfil</title>
    <link rel="stylesheet" href="./views/css/perfil.css">
</head>
<body>
    <div class="perfil-container">
        <h1>Bienvenido, <?php echo htmlspecialchars($nombre_usuario); ?></h1>
        <div class="foto-perfil">
            <a href="./index.php">
                <img src="views/img/perfil/perfil.png" alt="Foto de perfil" class="profile-pic">
            </a>
        </div>
    </div>
</body>
</html>
