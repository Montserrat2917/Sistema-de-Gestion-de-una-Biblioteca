<?php
/*
Equipo 5
Ramirez Guzman Ramiro
Reyes Magaña Brayan Emmanuel
Sanchez Loza Montserrat Guadalupe
Suarez Camarena Kimberly Lizbeth
*/
session_start(); 
include("conexion.php");

if (!isset($_POST['usuario']) || !isset($_POST['contraseña'])) {
    header("Location: index.php?error=Campos vacíos");
    exit();
}

$conn = conectarBD();
    
$usuario = pg_escape_string($conn, $_POST['usuario']);
$contraseña = pg_escape_string($conn, $_POST['contraseña']);


$query = "SELECT * FROM \"Usuario\" WHERE \"usuario\" = $1 AND \"contraseña\" = $2";
$result = pg_query_params($conn, $query, array($usuario, $contraseña));

if (pg_num_rows($result) > 0) {
    $_SESSION['usuario'] = $usuario; // guardar sesion

    if ($usuario === 'Administrador') {
        header("Location: admin_dashboard.php");
        exit(); 
    }
    else if ($usuario === 'Blas') {
        header("Location: empleado_dashboard.php");
        exit();
    }
} else {
    header("Location: index.php?error=Credenciales incorrectas");
    exit();
}

pg_close($conn);
?>