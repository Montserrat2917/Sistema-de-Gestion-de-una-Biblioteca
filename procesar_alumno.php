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

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['mensaje_error'] = "Método no permitido";
    header("Location: alta_alumno.php");
    exit();
}

// Conexión a PostgreSQL
$conn = pg_connect("host=localhost port=5432 dbname=Biblioteca user=postgres password=1234");
if (!$conn) {
    $_SESSION['mensaje_error'] = "Error al conectar a la base de datos";
    header("Location: alta_alumno.php");
    exit();
}

// Sanitizar entradas
$codigo = pg_escape_string($conn, $_POST['codigo'] ?? '');
$nombre = pg_escape_string($conn, $_POST['nombre'] ?? '');
$carrera = pg_escape_string($conn, $_POST['carrera'] ?? '');
$correo_electronico = pg_escape_string($conn, $_POST['correo_electronico'] ?? '');

// Validaciones básicas
if (empty($codigo) || empty($nombre) || empty($carrera) || empty($correo_electronico)) {
    $_SESSION['mensaje_error'] = "Todos los campos son obligatorios";
    header("Location: alta_alumno.php");
    exit();
}

if (!is_numeric($codigo)) {
    $_SESSION['mensaje_error'] = "Codigo invalido";
    header("Location: alta_alumno.php");
    exit();
}

if (!filter_var($correo_electronico, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['mensaje_error'] = "Correo no valido";
    header("Location: alta_alumno.php");
    exit();
}

// Verificar si el código ya existe
$query_verificar_codigo = 'SELECT 1 FROM "Alumno" WHERE codigo = $1';
$result_codigo = pg_query_params($conn, $query_verificar_codigo, [$codigo]);
if (pg_num_rows($result_codigo) > 0) {
    $_SESSION['mensaje_error'] = "El código ya esta registrado";
    header("Location: alta_alumno.php");
    exit();
}

// Verificar si el correo ya existe
$query_verificar_correo = 'SELECT 1 FROM "Alumno" WHERE correo_electronico = $1';
$result_correo = pg_query_params($conn, $query_verificar_correo, [$correo_electronico]);
if (pg_num_rows($result_correo) > 0) {
    $_SESSION['mensaje_error'] = "El correo ya está registrado";
    header("Location: alta_alumno.php");
    exit();
}

// Insertar nuevo registro
$query_insert = 'INSERT INTO "Alumno" (codigo, nombre, carrera, correo_electronico) 
                 VALUES ($1, $2, $3, $4)';
$params = [$codigo, $nombre, $carrera, $correo_electronico];

$result = pg_query_params($conn, $query_insert, $params);

if ($result) {
    $_SESSION['mensaje_exito'] = "Almuno registrado exitosamente";
} else {
    $_SESSION['mensaje_error'] = "Error al registrar: " . pg_last_error($conn);
}

pg_close($conn);
header("Location: alta_alumno.php");
exit();
?>