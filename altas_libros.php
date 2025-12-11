<?php
/*
Equipo 5
Ramirez Guzman Ramiro
Reyes Magaña Brayan Emmanuel
Sanchez Loza Montserrat Guadalupe
Suarez Camarena Kimberly Lizbeth
*/
session_start();

// Verificar sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

// Recuperar mensajes de la sesión
$mensaje_exito = $_SESSION['mensaje_exito'] ?? '';
$mensaje_error = $_SESSION['mensaje_error'] ?? '';

// Limpiar mensajes después de usarlos
unset($_SESSION['mensaje_exito']);
unset($_SESSION['mensaje_error']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Libros - Biblioteca</title>
    <link rel="stylesheet" href="alta_profesores.css">
    <style>
        .mensaje {
            padding: 12px;
            margin: 15px 0;
            border-radius: 5px;
            font-weight: bold;
        }
        .exito {
            background-color: #e1f7e5;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
        }
        .error {
            background-color: #ffebee;
            color: #c62828;
            border: 1px solid #ffcdd2;
        }
    </style>
</head>
<body>
    <div class="main-window">
        <!-- Menú lateral -->
        <div class="sidebar">
            <div class="menu-header">
                <img src="img/libros3.png" alt="Icono administrador" class="menu-icon">
                <h3>Libros</h3>
            </div>
            
            <a href="altas_libros.php" class="menu-link">
                <div class="menu-item active">
                    <img src="img/libros3.png" alt="Alumnos" class="menu-icon">
                    <span>Altas</span>
                </div>
            </a>
            
            <a href="consulta_libro.php" class="menu-link">
                <div class="menu-item">
                    <img src="img/consulta.png" alt="Consultas" class="menu-icon">
                    <span>Consultas</span>
                </div>
            </a>

            <a href="admin_dashboard.php" class="regresar">
                <div class="menu-item">
                    <img src="img/atras.png" alt="Regresar" class="menu-icon">
                    <span>Regresar</span>
                </div>
            </a>
            
            <div class="logout-container">
        <a href="logout.php" class="logout-button">
            <img src="img/cerrar-sesion.png" alt="Cerrar sesión" class="menu-icon">
            <span>Cerrar sesión</span>
        </a>
    </div>
        </div>

        <!-- Contenido principal -->
        <div class="main-content">
            <div class="alta-alumno">
                <h2>Registro de Nuevo Libro</h2>
                
                <?php if ($mensaje_exito): ?>
                    <div class="mensaje exito">✓ <?= htmlspecialchars($mensaje_exito) ?></div>
                <?php endif; ?>
                
                <?php if ($mensaje_error): ?>
                    <div class="mensaje error">✗ <?= htmlspecialchars($mensaje_error) ?></div>
                <?php endif; ?>
                
                <form action="procesar_libro.php" method="post">
                    <div class="form-group">
                        <label for="isbn">ISBN:</label>
                        <input type="text" id="isbn" name="isbn" class="campo-texto" required>
                    </div>

                    <div class="form-group">
                        <label for="titulo">Título:</label>
                        <input type="text" id="titulo" name="titulo" class="campo-texto" required>
                    </div>

                    <div class="form-group">
                        <label for="autor">Autor:</label>
                        <input type="text" id="autor" name="autor" class="campo-texto" required>
                    </div>

                    <div class="form-group">
                        <label for="editorial">Editorial:</label>
                        <input type="text" id="editorial" name="editorial" class="campo-texto" required>
                    </div>

                    <div class="form-group">
                        <label for="año_de_publicacion">Año de publicación:</label>
                        <input type="number" id="año_de_publicacion" name="año_de_publicacion" class="campo-texto" required>
                    </div>

                    <div class="form-group">
                        <label for="numero_de_ejemplar">Número de ejemplar:</label>
                        <input type="text" id="numero_de_ejemplar" name="numero_de_ejemplar" class="campo-texto" required>
                    </div>
                    
                    <div class="form-actions">
                        <input type="submit" value="Registrar Libro" class="boton-enviar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>