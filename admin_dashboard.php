<?php
// Equipo 5
/*
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
    <title>Panel de Administración - Biblioteca</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="main-window">
        <!-- Menu lateral -->
        <div class="sidebar"> 
            <div class="menu-header">
                <img src="img/ajustes (2).png" alt="Icono administrador" class="menu-icon">
                <h3>Administrador</h3>
            </div>
            
            <a href="alumnos.php" class="menu-link">    
                <div class="menu-item">
                    <img src="img/alumno.png" alt="Alumnos" class="menu-icon">
                    <span>Alumnos</span>
                </div>
            </a>
            
            <a href="profesores.php" class="menu-link">
                <div class="menu-item">
                    <img src="img/profesor2.png" alt="Alumnos" class="menu-icon">
                    <span>Profesores</span>
                </div>
            </a>
            
            <a href="libros.php" class="menu-link">
                <div class="menu-item">
                    <img src="img/libros3.png" alt="Alumnos" class="menu-icon">
                    <span>Libros</span>
                </div>
            </a>

            <!-- Boton Cerrar sesión al fondo -->
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