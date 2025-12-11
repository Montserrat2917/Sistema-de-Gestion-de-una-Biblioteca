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
    header("Location: ../index.php");
    exit();
}

$usuario_actual = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Empleado - Biblioteca</title>
    <style>
   /* Reset básico para eliminar márgenes y padding predeterminados */
body {
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f8f9fa;
    color: #212529;
    overflow-x: hidden; /* Evita scroll horizontal */
}

/* Estructura principal */
.main-window {
    display: flex;
    min-height: 100vh;
}

/* Menú lateral FIJADO y ajustado */
.sidebar {
    background-color: #1e3d59;
    color: #fff;
    width: 240px;
    padding: 1.5rem 1rem;
    display: flex;
    flex-direction: column;
    gap: 15px;
    position: fixed; /* Fija el menú */
    top: 0;
    left: 0;
    height: 100vh; /* Altura completa */
    box-sizing: border-box; /* Incluye padding en el ancho */
    z-index: 1000; /* Encima de otros elementos */
    border-right: 1px solid #152f4a; /* Línea divisoria opcional */
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1); /* Sombra sutil */
}

/* Ajuste del contenido principal */
.main-content {
    flex: 1;
    padding: 2rem;
    margin-left: 240px; /* Igual al ancho del sidebar */
    width: calc(100% - 240px); /* Ajuste preciso */
    box-sizing: border-box;
}

/* Estilos de los elementos del menú (se mantienen igual) */
.menu-link {
    text-decoration: none;
    color: white;
}

.menu-header,
.menu-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 15px;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.3s;
}

.menu-header {
    padding: 10px 15px 20px;
    border-bottom: 1px solid #2d5275;
    margin-bottom: 10px;
}

.menu-header h3 {
    font-size: 1.3rem;
    margin: 0;
}

.menu-item {
    background-color: transparent;
}

.menu-item:hover {
    background-color: #284a6e;
}

.menu-icon {
    width: 20px;
    height: 20px;
    object-fit: contain;
}

/* Estilos del contenido */
.header {
    padding: 2rem;
    border-radius: 12px;
    text-align: center;
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 2rem;
}

.image-section {
    background-image: url('img/biblio2.jpg');
    background-size: cover;
    background-position: center;
    height: 200px;
    border-radius: 12px;
    margin-bottom: 2rem;
}

.content h2 {
    font-size: 1.75rem;
    margin-bottom: 1rem;
}

.user-info {
    background-color: #f1f3f5;
    padding: 10px 15px;
    border-left: 4px solid #0d6efd;
    border-radius: 5px;
    font-size: 1rem;
    margin-bottom: 1.5rem;
}

/* Botón cerrar sesión */
.logout-button {
    margin-top: auto;
    padding-top: 20px;
    border-top: 1px solid #2d5275;
}

.button {
    background-color: #2d5275;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    cursor: pointer;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 10px;
    justify-content: center;
    transition: background 0.3s;
    width: 100%;
}

.button:hover {
    background-color: #3a6a94;
}
    </style>
</head>
<body>
    <div class="main-window">
        <!-- Menu lateral -->
        <div class="sidebar"> 
            <div class="menu-header">
                <img src="img/empresario.png" alt="Icono empleado" class="menu-icon">
                <h3>Empleado</h3>
            </div>
            
            <a href="prestamos/prestamos.php" class="menu-link">
                <div class="menu-item">
                    <img src="img/prestamos-libro.png" alt="Prestamos" class="menu-icon">
                    <span>Prestamos</span>
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
                <h2>Bienvenido al Panel de Empleado</h2>

                <div class="user-info">
                    Usuario: <strong><?php echo htmlspecialchars($usuario_actual); ?></strong>
                </div>
            </div>
        </div>
    </div>
</body>
</html>