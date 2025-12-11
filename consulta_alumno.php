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

// Conexión a PostgreSQL
$conn = pg_connect("host=localhost port=5432 dbname=Biblioteca user=postgres password=1234");
if (!$conn) {
    $_SESSION['mensaje_error'] = "Error al conectar a la base de datos";
    header("Location: consulta_alumno.php");
    exit();
}

// Consulta para obtener todos los alumnos
$query = 'SELECT codigo, nombre, carrera, correo_electronico FROM "Alumno" ORDER BY nombre';
$result = pg_query($conn, $query);

if (!$result) {
    $_SESSION['mensaje_error'] = "Error al consultar alumnos: " . pg_last_error($conn);
    pg_close($conn);
    header("Location: consulta_alumno.php");
    exit();
}

$alumno = pg_fetch_all($result);
pg_close($conn);

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
    <title>Consulta de Alumnos - Biblioteca</title>
    <link rel="stylesheet" href="consulta_alumno.css">
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
                <img src="img/alumno.png" alt="Icono administrador" class="menu-icon">
                <h3>Alumnos</h3>
            </div>
            
            <a href="alta_alumno.php" class="menu-link">
                <div class="menu-item">
                    <img src="img/agregar-usuario.png" alt="Alumnos" class="menu-icon">
                    <span>Altas</span>
                </div>
            </a>
            
            <a href="consulta_alumno.php" class="menu-link">
                <div class="menu-item active">
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
            <h2>Consulta de Alumnos Registrados</h2>
            
            <?php if ($mensaje_exito): ?>
                <div class="mensaje exito">✓ <?= htmlspecialchars($mensaje_exito) ?></div>
            <?php endif; ?>
            
            <?php if ($mensaje_error): ?>
                <div class="mensaje error">✗ <?= htmlspecialchars($mensaje_error) ?></div>
            <?php endif; ?>
            
            <div class="tabla-container">
                <?php if ($alumno && count($alumno) > 0): ?>
                    <table class="tabla-alumnos">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Carrera</th>
                                <th>Correo Electrónico</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($alumno as $alumno): ?>
                            <tr>
                                <td><?= htmlspecialchars($alumno['codigo']) ?></td>
                                <td><?= htmlspecialchars($alumno['nombre']) ?></td>
                                <td><?= htmlspecialchars($alumno['carrera']) ?></td>
                                <td><?= htmlspecialchars($alumno['correo_electronico']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="sin-registros">No hay alumnos registrados.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>