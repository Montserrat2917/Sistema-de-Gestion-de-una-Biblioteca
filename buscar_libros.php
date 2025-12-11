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

$usuario_actual = $_SESSION['usuario'];

$host = "localhost";
$port = "5432";
$dbname = "Biblioteca";   // Cambia esto por tu nombre real de BD
$user = "postgres";      // Tu usuario de PostgreSQL
$password = "1234";        // Y tu contraseña

// Conexión a la base de datos
try {
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obtener todos los libros
    $sql = 'SELECT isbn, titulo, autor, editorial, año_de_publicacion, numero_de_ejemplar FROM "libro"';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error de conexión o consulta: " . $e->getMessage();
    die();
}
?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de libros</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }
        .header {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 80%;
            margin-top: 20px;
        }
        .menu {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            margin-bottom: 50px;
            width: 50%; 
            margin: 20px auto; 
        }
        
        .boton {
            background-color: #2c3e50;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 20px;
            cursor: pointer;
            font-weight: 600;
            margin: 2px;
            transition: background-color 0.3s;
        }
        .boton:hover {
            background-color: #3730a3;
        }
        h3 {
            color: #1e293b;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20;
            background-color: #f4f4f9;
            text-align: center;
        }
        .agregar {
            margin-bottom: 20px;
            text-align: right;
            padding: 10px 15px;
        }
        .agregar a {
            margin: 135px; 
            text-decoration: none;
            padding: 10px 15px;
            background-color: #2c3e50;
            color: white;
            border-radius: 8px;
        }
        .agregar a:hover {
            background-color: #3730a3;
        }
        table {
            margin: 20px auto; 
            width: 80%;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            border-collapse: collapse;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #2c3e50;
            color: white;
        }
        .actions-links a {
            margin-right: 10px;
            text-decoration: none;
            color: #007bff;
        }

        a {
            display: block;
            margin: 16px auto 0;
            width: 50%;
            padding: 8px;
            background-color: #2c3e50;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            text-align: center; 
            transition: background-color 0.3s;
            font-weight: 600;
        }

         a:hover {
            background-color: #3730a3;
        }
    </style>

</head> 
<body>
    <div class="header">
        <h1>Lista de libros</h1>
    </div> 

    <div>
        <table>
            <thead>
                <tr>
                    <th>ISBN</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Editorial</th>
                    <th>Año de publicación</th>
                    <th>Numero de ejemplar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($res as $row): ?>
                    <tr id="fila-<?php echo htmlspecialchars($row['isbn']); ?>">
                        <td><?php echo htmlspecialchars($row['isbn']); ?></td>
                        <td><?php echo htmlspecialchars($row['titulo']); ?></td>
                        <td><?php echo htmlspecialchars($row['autor']); ?></td>
                        <td><?php echo htmlspecialchars($row['editorial']); ?></td>
                        <td><?php echo htmlspecialchars($row['año_de_publicacion']); ?></td>
                        <td><?php echo htmlspecialchars($row['numero_de_ejemplar']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <a href="libros.php">Regresar</a>

</body>
</html>
