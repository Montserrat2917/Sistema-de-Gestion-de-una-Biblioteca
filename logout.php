<?php
/*
Equipo 5
Ramirez Guzman Ramiro
Reyes Magaña Brayan Emmanuel
Sanchez Loza Montserrat Guadalupe
Suarez Camarena Kimberly Lizbeth
*/
session_start();
session_destroy(); // Destruye la sesión
header("Location: index.php"); // Redirige al login
exit();
?>