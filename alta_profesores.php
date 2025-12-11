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
    <title>Registro de Profesores - Biblioteca</title>
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
                <img src="img/profesor2.png" alt="Icono administrador" class="menu-icon">
                <h3>Profesores</h3>
            </div>
            
            <a href="alta_profesores.php" class="menu-link">
                <div class="menu-item active">
                    <img src="img/agregar-usuario.png" alt="Alumnos" class="menu-icon">
                    <span>Altas</span>
                </div>
            </a>
            
            <a href="consulta_profesor.php" class="menu-link">
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
                <h2>Registro de Nuevo Profesor</h2>
                
                <?php if ($mensaje_exito): ?>
                    <div class="mensaje exito">✓ <?= htmlspecialchars($mensaje_exito) ?></div>
                <?php endif; ?>
                
                <?php if ($mensaje_error): ?>
                    <div class="mensaje error">✗ <?= htmlspecialchars($mensaje_error) ?></div>
                <?php endif; ?>
                
                <form action="procesar_profesor.php" method="post">
                    <div class="form-group">
                        <label for="codigo">Código:</label>
                        <input type="text" id="codigo" name="codigo" class="campo-texto" 
                               required>
                    </div>
                    
                    <div class="form-group">
                        <label for="nombre">Nombre completo:</label>
                        <input type="text" id="nombre" name="nombre" class="campo-texto" 
                              required>
                    </div>
                    
                    <div class="form-group">
                        <label for="carrera">Carrera:</label>
                        <input type="text" id="carrera" name="carrera" class="campo-texto" 
                               required>
                    </div>
                    
                    <div class="form-group">
                        <label for="correo">Correo electrónico:</label>
                        <input type="email" id="correo" name="correo" class="campo-texto" 
                               required>
                    </div>

                    <div class="form-group">
                        <label for="fecha">Fecha de contratacion:</label>
                        <input type="text" id="fecha_cont" name="fecha_cont" class="campo-texto" 
                               required>
                    </div>

                    <div class="form-group">
                        <label for="antiguedad">Antiguedad:</label>
                        <input type="text" id="antiguedad" name="antiguedad" class="campo-texto" 
                               required>
                    </div>
                    
                    <div class="form-actions">
                        <input type="submit" value="Registrar Profesor" class="boton-enviar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>