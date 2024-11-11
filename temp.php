<?php
    include 'controller/conexion.php'
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <title>Peliculas Onlines</title>
    <link rel="stylesheet" href="./views/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

    <header class="header">
        <a class="logo" href="./index.php"><img src="views/img/Arf.png" alt=""></a>
    
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
                    <a href="#" onclick="toggleSubmenu()"><img src="views/img/perfil/perfil.png" alt="Foto de perfil" class="profile-pic"></a>
                    <ul class="submenu">
                        <li><a href="views/pages/nosotros.html">Cerrar Sesión</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </header>

    [71, 75, 72, 69, 76,82,64,85,61]

    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
        <?php
            $ids_peliculas = [71, 75, 72, 69, 76,82,64,85,61]; // IDs de las diapositivas a mostrar
            $placeholders = implode(',', array_fill(0, count($ids_peliculas), '?'));
            $query = "SELECT * FROM sliderauto WHERE id IN ($placeholders)";
            $stmt = $conexion->prepare($query);
            $stmt->bind_param(str_repeat("i", count($ids_peliculas)), ...$ids_peliculas);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows > 0) {
                // Recorrer los resultados y crear los elementos del slider
                while ($row = $resultado->fetch_assoc()) {
                    echo '<div class="swiper-slide">';
                        echo '<img src="views/img/' . htmlspecialchars($row['background']) . '" alt="Fondo de ' . htmlspecialchars($row['titulo']) . '">';
                        echo '<div class="content">';
                            echo '<div class="content-img"><img src="views/img/' . htmlspecialchars($row['titulo']) . '" alt="Título"></div>';
                            echo '<p>' . htmlspecialchars($row['descripcion']) . '</p>';
                            echo '<a href="#" class="btn" onclick="redirigirDetalle(' . htmlspecialchars($row['id']) . ')"><i class="bx bx-play"></i></a>';
                            echo '<a href="#" class="btn" onclick="redirigirDetalle(' . htmlspecialchars($row['id']) . ')"><i class="bx bx-info-circle"></i> Más información</a>';
                        echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "No se encontraron las diapositivas seleccionadas.";
            }

            $stmt->close();
            ?>

        </div>

        <!-- Paginación (si se usa) -->
        <div class="swiper-pagination"></div>
    </div>

    <main>
        <section class="movie">
            <h2>Películas de Acción</h2>
            <div class="wrapper">
                <i id="left" class="fa-solid fa-angle-left"></i>
                <ul class="carousel">
                    <?php
                    $ids_peliculas = [61, 62, 63, 64, 65]; // IDs de películas a mostrar
                    $placeholders = implode(',', array_fill(0, count($ids_peliculas), '?'));
                    $query = "SELECT * FROM peliculas WHERE id IN ($placeholders)";
                    $stmt = $conexion->prepare($query);
                    $stmt->bind_param(str_repeat("i", count($ids_peliculas)), ...$ids_peliculas);
                    $stmt->execute();
                    $resultado = $stmt->get_result();

                    if ($resultado->num_rows > 0) {
                        while ($row = $resultado->fetch_assoc()) {
                            echo '<li class="card" onclick="redirigirDetalle(' . $row['id'] . ')">';
                            echo '<div class="img"><img src="views/img/' . $row['img'] . '" alt="" draggable="false"></div>';
                            echo '<h3>' . $row['titulo'] . '</h3>';
                            echo '</li>';
                        }
                    } else {
                        echo "No se encontraron las películas seleccionadas.";
                    }

                    $stmt->close();
                    ?>
                </ul>
                <i id="right" class="fa-solid fa-angle-right"></i>
            </div>
        </section>
        <section class="movie">
            <h2>Películas de Comedia</h2>
            <div class="wrapper">
                <i id="left" class="fa-solid fa-angle-left"></i>
                <ul class="carousel">
                    <?php
                    $ids_peliculas = [66 ,67 ,68 ,69 ,70]; // IDs de películas a mostrar
                    $placeholders = implode(',', array_fill(0, count($ids_peliculas), '?'));
                    $query = "SELECT * FROM peliculas WHERE id IN ($placeholders)";
                    $stmt = $conexion->prepare($query);
                    $stmt->bind_param(str_repeat("i", count($ids_peliculas)), ...$ids_peliculas);
                    $stmt->execute();
                    $resultado = $stmt->get_result();

                    if ($resultado->num_rows > 0) {
                        while ($row = $resultado->fetch_assoc()) {
                            echo '<li class="card" onclick="redirigirDetalle(' . $row['id'] . ')">';
                            echo '<div class="img"><img src="views/img/' . $row['img'] . '" alt="" draggable="false"></div>';
                            echo '<h3>' . $row['titulo'] . '</h3>';
                            echo '</li>';
                        }
                    } else {
                        echo "No se encontraron las películas seleccionadas.";
                    }

                    $stmt->close();
                    ?>
                </ul>
                <i id="right" class="fa-solid fa-angle-right"></i>
            </div>
        </section>
        <section class="movie">
            <h2>Películas de Aventura</h2>
            <div class="wrapper">
                <i id="left" class="fa-solid fa-angle-left"></i>
                <ul class="carousel">
                    <?php
                    $ids_peliculas = [71, 72, 73, 74, 75]; // IDs de películas a mostrar
                    $placeholders = implode(',', array_fill(0, count($ids_peliculas), '?'));
                    $query = "SELECT * FROM peliculas WHERE id IN ($placeholders)";
                    $stmt = $conexion->prepare($query);
                    $stmt->bind_param(str_repeat("i", count($ids_peliculas)), ...$ids_peliculas);
                    $stmt->execute();
                    $resultado = $stmt->get_result();

                    if ($resultado->num_rows > 0) {
                        while ($row = $resultado->fetch_assoc()) {
                            echo '<li class="card" onclick="redirigirDetalle(' . $row['id'] . ')">';
                            echo '<div class="img"><img src="views/img/' . $row['img'] . '" alt="" draggable="false"></div>';
                            echo '<h3>' . $row['titulo'] . '</h3>';
                            echo '</li>';
                        }
                    } else {
                        echo "No se encontraron las películas seleccionadas.";
                    }

                    $stmt->close();
                    ?>
                </ul>
                <i id="right" class="fa-solid fa-angle-right"></i>
            </div>
        </section>
        <section class="movie">
            <h2>Películas de Ciencia Fisión</h2>
            <div class="wrapper">
                <i id="left" class="fa-solid fa-angle-left"></i>
                <ul class="carousel">
                    <?php
                    $ids_peliculas = [76,77,78,79,80]; // IDs de películas a mostrar
                    $placeholders = implode(',', array_fill(0, count($ids_peliculas), '?'));
                    $query = "SELECT * FROM peliculas WHERE id IN ($placeholders)";
                    $stmt = $conexion->prepare($query);
                    $stmt->bind_param(str_repeat("i", count($ids_peliculas)), ...$ids_peliculas);
                    $stmt->execute();
                    $resultado = $stmt->get_result();

                    if ($resultado->num_rows > 0) {
                        while ($row = $resultado->fetch_assoc()) {
                            echo '<li class="card" onclick="redirigirDetalle(' . $row['id'] . ')">';
                            echo '<div class="img"><img src="views/img/' . $row['img'] . '" alt="" draggable="false"></div>';
                            echo '<h3>' . $row['titulo'] . '</h3>';
                            echo '</li>';
                        }
                    } else {
                        echo "No se encontraron las películas seleccionadas.";
                    }

                    $stmt->close();
                    ?>
                </ul>
                <i id="right" class="fa-solid fa-angle-right"></i>
            </div>
        </section>
        <section class="movie">
            <h2>Películas de Misterio</h2>
            <div class="wrapper">
                <i id="left" class="fa-solid fa-angle-left"></i>
                <ul class="carousel">
                    <?php
                    $ids_peliculas = [81, 82, 83, 84, 85]; // IDs de películas a mostrar
                    $placeholders = implode(',', array_fill(0, count($ids_peliculas), '?'));
                    $query = "SELECT * FROM peliculas WHERE id IN ($placeholders)";
                    $stmt = $conexion->prepare($query);
                    $stmt->bind_param(str_repeat("i", count($ids_peliculas)), ...$ids_peliculas);
                    $stmt->execute();
                    $resultado = $stmt->get_result();

                    if ($resultado->num_rows > 0) {
                        while ($row = $resultado->fetch_assoc()) {
                            echo '<li class="card" onclick="redirigirDetalle(' . $row['id'] . ')">';
                            echo '<div class="img"><img src="views/img/' . $row['img'] . '" alt="" draggable="false"></div>';
                            echo '<h3>' . $row['titulo'] . '</h3>';
                            echo '</li>';
                        }
                    } else {
                        echo "No se encontraron las películas seleccionadas.";
                    }

                    $stmt->close();
                    ?>
                </ul>
                <i id="right" class="fa-solid fa-angle-right"></i>
            </div>
        </section>
    </main>
    
    <a href="#peliculas" id="backToTop" class="back-to-top">↑</a>

    <footer>
        <div class="footer-container" id="contacto">
            <a href="index.html" class="footer-logo"><img src="views/img/Arf.png" alt="Logo de Arflix"></a>
            <div class="footer-lists">
                <ul class="footer-list">
                    <h2>Contacto</h2>
                    <li class="footer-item"><p><i class='bx bx-envelope'></i> arflix@gmail.com</p></li>
                    <li class="footer-item"><p><i class='bx bx-phone' ></i> +54 11 5500-4321</p></li>
                </ul>
                <ul class="footer-list">
                    <h2>Navegacion</h2>
                    <li class="footer-item"><a href="#home">Inicio</a></li>
                    <li class="footer-item"><a href="#">Sobre nosotros</a></li>
                    <li class="footer-item"><a href="#peliculas">Peliculas</a></li>
                    <li class="footer-item"><a href="#series">Series</a></li>
                    
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
        <h2 class="footer-h">©2024 Arflix. Todos los derechos reservados</h2>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="views/javascript/script.js"></script>
    <script src="views/javascript/redireccion.js"></script>

</body>
</html>