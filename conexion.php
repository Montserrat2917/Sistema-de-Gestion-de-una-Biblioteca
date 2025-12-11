<?php
// Equipo 5
/*
Ramirez Guzman Ramiro
Reyes Magaña Brayan Emmanuel
Sanchez Loza Montserrat Guadalupe
Suarez Camarena Kimberly Lizbeth
*/
function conectarBD() {
    $host = "localhost";
    $port = "5432";
    $dbname = "Biblioteca";   // Cambia esto por tu nombre real de BD
    $user = "postgres";      // Tu usuario de PostgreSQL
    $password = "1234";        // Y tu contraseña

    $conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

    if (!$conn) {
        die("Error al conectar con la base de datos.");
    }

    return $conn;
}
?>
