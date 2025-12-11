<?php
/*
Equipo 5
Ramirez Guzman Ramiro
Reyes Magaña Brayan Emmanuel
Sanchez Loza Montserrat Guadalupe
Suarez Camarena Kimberly Lizbeth
*/
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$usuario_actual = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Libros - Biblioteca</title>
    <link rel="stylesheet" href="libros.css">
</head>
<body>
    <div class="main-window">
        <!-- Menu lateral -->
        <div class="sidebar"> 
            <div class="menu-header">
                <img src="img/libros3.png" alt="Icono administrador" class="menu-icon">
                <h3>Libros</h3>
            </div>
            
            <a href="altas_libros.php" class="menu-link">
                <div class="menu-item">
                    <img src="img/libros3.png" alt="Libros" class="menu-icon">
                    <span>Altas</span>
                </div>
            </a>
            
            <a href="consulta_libro.php" class="menu-link">
                <div class="menu-item">
                    <img src="img/consulta.png" alt="Libros" class="menu-icon">
                    <span>Consultas generales</span>
                </div>
            </a>


            <!-- Boton Cerrar sesión al fondo -->
            <a href="admin_dashboard.php" class="regresar">
                <div class="menu-item">
                    <img src="img/atras.png" alt="Libros" class="menu-icon">
                    <span>Regresar</span>
                </div>
            </a>
            
            <div class="menu-item logout-button">
                <img src="img/cerrar-sesion.png" alt="Cerrar sesión" class="menu-icon">
                <a href="logout.php" class="button">Cerrar sesión</a>
            </div>
        </div>

        <!-- Area de contenido principal -->
        <div class="main-content">
            <div class="header">Sistema de Biblioteca</div>

            <div class="image-section"></div>

            <div class="content">
                <h2>Bienvenido al Panel de Administración</h2>

                <div class="user-info">
                    Usuario: <strong><?php echo htmlspecialchars($usuario_actual); ?></strong>
                </div>
            </div>
        </div>
    </div>
</body>
</html>