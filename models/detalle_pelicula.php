<?php
include '../controller/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Preparamos la consulta en la tabla correcta
    $consulta = "SELECT * FROM peliculas WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $consulta);

    if ($stmt) {
        // Bind del parámetro
        mysqli_stmt_bind_param($stmt, "i", $id);

        // Ejecutar la consulta
        mysqli_stmt_execute($stmt);

        // Obtener el resultado
        $resultado = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($resultado) > 0) {
            $row = mysqli_fetch_assoc($resultado);
            $titulo = $row['tmg'];
            $genero = $row['genero'];
            $descripcion = $row['descripcion'];
            $trailer = $row['trailer'];
            // Nuevas variables
            $duracion = $row['duracion'];
            $temporada = $row['temporadas'];
            $anio = $row['anio'];
            $elenco = $row['elenco'];
            $img = $row['img'];  // Suponiendo que la imagen está almacenada en la base de datos
        } else {
            echo "No se encontró la película.";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error en la preparación de la consulta: " . mysqli_error($conexion);
    }
} else {
    echo "ID no proporcionado.";
}

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($titulo); ?></title>
    <link rel="stylesheet" href="../views/css/estilos.css"> <!-- Enlace a tu archivo CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

    <header class="header">
        <a class="logo" href="../index.php"><img src="views/img/Arf.png" alt=""></a>

        <input type="checkbox" id="check">
        <label for="check" class="icons">
            <i class="bx bx-menu" id="menu-icon"></i>
            <i class="bx bx-x" id="close-icon"></i>
        </label>

        <nav class="navbar">  
            <a href="../../portal/index.php" style="--i:0;">Inicio</a>
            <a href="../../portal/movies.php" style="--i:2;">Peliculas</a>
            <a href="../../portal/temp.php" style="--i:3;">Series</a>
            <a href="#contacto" style="--i:4;">Contacto</a>
        </nav>
        <div class="menu">
            <ul>
                <li class="perfil">
                    <a href="#" onclick="toggleSubmenu()"><img src="../views/img/perfil/perfil.png" alt="Foto de perfil" class="profile-pic"></a>
                    <ul class="submenu">
                        <li><a href="../views/pages/nosotros.html">Cerrar Sesión</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </header>

    <div class="container">
        <div class="header">
            <a href="../index.php" class="back-button"><i class='bx bxs-x-circle'></i></a>
                <div class="movie-image">
                    <?php if (!empty($img)) { ?>
                        <img src="../views/img/<?php echo htmlspecialchars($img); ?>" alt="Imagen de la película">
                    <?php } else { ?>
                        <p>Imagen no disponible.</p>
                    <?php } ?>
                </div>
                <div class="movie-title">
                    <?php if (!empty($titulo)) { ?>
                        <img src="../views/img/<?php echo htmlspecialchars($titulo); ?>" alt="Imagen de la película">
                    <?php } else { ?>
                        <p>Imagen no disponible.</p>
                    <?php } ?>
                </div>
                    
            <div class="info">
                <div class="left-info">
                    <ul>
                        <li class="year-duration">
                            <strong>Año: <?php echo !empty($anio) ? htmlspecialchars($anio) : 'No disponible'; ?> |  </strong>
                            <?php if (!empty($duracion)) { ?>
                                <strong class="duration">Duración: <?php echo htmlspecialchars($duracion); ?> </strong> 
                            <?php } elseif (!empty($temporada)) { ?>
                                <strong class="temp">Temporada: <?php echo htmlspecialchars($temporada); ?></strong> 
                            <?php } ?>
                        </li>
                    </ul>
                </div>
                            
                <div class="right-info">
                    <p class="genre"><strong>Género:</strong> <?php echo htmlspecialchars($genero); ?></p>
                    <p class="cast"><strong>Elenco:</strong> <?php echo !empty($elenco) ? htmlspecialchars($elenco) : 'No disponible'; ?></p>
                </div>
            </div>
                            
            <div class="description">
                <p><strong>Descripción:</strong> <?php echo htmlspecialchars($descripcion); ?></p>
            </div>
                <div class="trailer-container">
                    <?php if (!empty($trailer)) { ?>
                        <iframe src="https://www.youtube.com/embed/<?php echo htmlspecialchars($trailer); ?>" allowfullscreen></iframe>
                    <?php } else { ?>
                        <p>Tráiler no disponible.</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
            
    <footer>
        <div class="footer-container" id="contacto">
            <div class="footer-logo">
                <img src="../views/img/Arf.png" alt="Logo de Arflix">
            </div>
            <div class="footer-lists">
                <ul class="footer-list">
                    <h2>Contacto</h2>
                    <li class="footer-item">
                        <p>Email: arflix@gmail.com</p>
                    </li>
                    <li class="footer-item">
                        <p>Teléfono: +54 11 5500-4321</p>
                    </li>
                </ul>
                <ul class="footer-list">
                    <h2>Navegación</h2>
                    <li class="footer-item"><a href="#home">Inicio</a></li>
                    <li class="footer-item"><a href="../movies.php">Peliculas</a></li>
                    <li class="footer-item"><a href="../temp.php">Series</a></li>
                </ul>
                <div class="footer-list social">
                    <h2>Redes Sociales</h2>
                    <div class="footer-items">
                        <a href="https://facebook.com" target="_blank">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="https://twitter.com" target="_blank">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://instagram.com" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="../views/javascript/script.js"></script>
</body>
</html>
