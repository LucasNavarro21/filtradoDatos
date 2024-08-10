<?php
require './Modelos/conexion.php';

$country = $_GET['country'] ?? '';
$cnae = $_GET['cnae'] ?? '';
$role = $_GET['role'] ?? '';
$industry = $_GET['industry'] ?? '';

// Consulta con filtros
$sql = "SELECT emailStatus, email, fullName, firstName, lastName, linkedinUrl, companyName, companyWebsite, icebreaker, country, location, industry, companyProfileUrl, civility, Role, CNAE FROM candidatos WHERE 1=1";

if ($country != '') {
    $sql .= " AND country LIKE '%" . $conn->real_escape_string($country) . "%'";
}
if ($cnae != '') {
    $sql .= " AND CNAE LIKE '%" . $conn->real_escape_string($cnae) . "%'";
}
if ($role != '') {
    $sql .= " AND Role LIKE '%" . $conn->real_escape_string($role) . "%'";
}
if ($industry != '') {
    $sql .= " AND industry LIKE '%" . $conn->real_escape_string($industry) . "%'";
}

$result = $conn->query($sql);

// Verifica si la consulta fue exitosa
if ($result === false) {
    die("Error en la consulta SQL: " . $conn->error);
}


// Incrementar el contador de descargas y enviar el correo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['export_csv'])) {
    $sql_update = "UPDATE candidatos SET DownloadCount = DownloadCount + 1 WHERE 1=1";
    if ($country != '') {
        $sql_update .= " AND country LIKE '%" . $conn->real_escape_string($country) . "%'";
    }
    if ($cnae != '') {
        $sql_update .= " AND CNAE LIKE '%" . $conn->real_escape_string($cnae) . "%'";
    }
    if ($role != '') {
        $sql_update .= " AND Role LIKE '%" . $conn->real_escape_string($role) . "%'";
    }
    if ($industry != '') {
        $sql_update .= " AND industry LIKE '%" . $conn->real_escape_string($industry) . "%'";
    }
    $conn->query($sql_update);
        
}
?>
