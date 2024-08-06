<?php
$servername = "localhost";
$username = "root";
// $password = "";
$dbname = "filtrodatos";

// Crear conexión
$conn = new mysqli($servername, $username, "", $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
