<?php 
require("../controller/conexion.php");

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $boton = $_POST['boton'];

    if($boton === 'registrar'){
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $telefono = $_POST["telefono"];
        $contra = $_POST['contra'];
        $confirmar = $_POST["confirmar"];

        if($contra == $confirmar){
            $sql = "INSERT INTO usuarios(nombre,email,telefono,clave) VALUES ('$nombre','$email','$telefono','$contra')";
            $resultado = $conexion->query($sql);

            if($resultado == TRUE){
                header("Location: ../views/pages/login.html");
                exit(); 
            } else {
                echo 'Hubo un error, revisa los datos.';
            }
        } else {
            echo 'Las contraseñas no coinciden.';
        }
    }

    if($boton === 'iniciar'){
        $email = $_POST['email'];
        $clave = $_POST['clave'];

        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $resultado = $conexion->query($sql);

        if($resultado->num_rows > 0){
            $fila = $resultado->fetch_assoc();

            if($clave === $fila['clave']){
                session_start();
                $_SESSION['id_usuario'] = $fila['id'];
                $_SESSION['nombre'] = $fila['nombre'];

                header("Location: /portal/perfil.php"); 
                exit();
            } else {
                echo 'Contraseña incorrecta.';
            }
        } else {
            echo 'Usuario no registrado.';
        }
    } else {
        echo 'No se pudo iniciar sesión.';
    }

} else {
    echo 'No se enviaron datos.';
}
?>

