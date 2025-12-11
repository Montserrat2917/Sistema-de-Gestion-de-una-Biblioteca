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
    header("Location: altas_libros.php");
    exit();
}

// Conexión a PostgreSQL
$conn = pg_connect("host=localhost port=5432 dbname=Biblioteca user=postgres password=1234");
if (!$conn) {
    $_SESSION['mensaje_error'] = "Error al conectar a la base de datos";
    header("Location: altas_libros.php");
    exit();
}

// Sanitizar entradas
$isbn = pg_escape_string($conn, $_POST['isbn'] ?? '');
$titulo = pg_escape_string($conn, $_POST['titulo'] ?? '');
$autor = pg_escape_string($conn, $_POST['autor'] ?? '');
$editorial = pg_escape_string($conn, $_POST['editorial'] ?? '');
$año_de_publicacion = pg_escape_string($conn, $_POST['año_de_publicacion'] ?? '');
$numero_de_ejemplar = pg_escape_string($conn, $_POST['numero_de_ejemplar'] ?? '');

// Validaciones básicas
if (empty($isbn) || empty($titulo) || empty($autor) || empty($editorial) || empty($año_de_publicacion) || empty($numero_de_ejemplar)) {
    $_SESSION['mensaje_error'] = "Todos los campos son obligatorios";
    header("Location: altas_libros.php");
    exit();
}

if (!is_numeric($año_de_publicacion) || strlen($año_de_publicacion) != 4) {
    $_SESSION['mensaje_error'] = "Año de publicación inválido";
    header("Location: altas_libros.php");
    exit();
}

if (!is_numeric($numero_de_ejemplar)) {
    $_SESSION['mensaje_error'] = "Número de ejemplar inválido";
    header("Location: altas_libros.php");
    exit();
}

// Verificar si el ISBN ya existe
$query_verificar = 'SELECT 1 FROM "Libro" WHERE isbn = $1';
$result_verificar = pg_query_params($conn, $query_verificar, [$isbn]);
if (pg_num_rows($result_verificar) > 0) {
    $_SESSION['mensaje_error'] = "El ISBN ya está registrado";
    header("Location: altas_libros.php");
    exit();
}

// Insertar nuevo libro
$query_insert = 'INSERT INTO "Libro" (isbn, titulo, autor, editorial, año_de_publicacion, numero_de_ejemplar) 
                 VALUES ($1, $2, $3, $4, $5, $6)';
$params = [$isbn, $titulo, $autor, $editorial, $año_de_publicacion, $numero_de_ejemplar];

$result = pg_query_params($conn, $query_insert, $params);

if ($result) {
    $_SESSION['mensaje_exito'] = "Libro registrado exitosamente";
} else {
    $_SESSION['mensaje_error'] = "Error al registrar: " . pg_last_error($conn);
}

pg_close($conn);
header("Location: altas_libros.php");
exit();
?>
