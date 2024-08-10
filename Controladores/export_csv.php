<?php
include '../Modelos/conexion.php';

$country = $_GET['country'] ?? '';
$cnae = $_GET['cnae'] ?? '';
$role = $_GET['role'] ?? '';
$industry = $_GET['industry'] ?? '';

$sql = "SELECT emailStatus, email, fullName, firstName, lastName, linkedinUrl, companyName, icebreaker, country, location, industry, companyWebsite, companyProfileUrl, civility, Role, CNAE, DownloadCount FROM candidatos WHERE 1=1";

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

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');

$output = fopen('php://output', 'w');
fputcsv($output, array('emailStatus', 'email', 'fullName', 'firstName', 'lastName', 'linkedinUrl', 'companyName', 'icebreaker', 'country', 'location', 'industry', 'companyWebsite', 'companyProfileUrl', 'civility', 'Role', 'CNAE', 'DownloadCount'));

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);

        // Incrementar DownloadCount
        $id = $row['email'];
        $update_sql = "UPDATE candidatos SET DownloadCount = DownloadCount + 1 WHERE email = '" . $conn->real_escape_string($id) . "'";
        $conn->query($update_sql);
    }
}
fclose($output);

// Enviar correo electrónico
$to = 'luketexchingewuey@gmail.com';
$subject = 'Nueva descarga de leads';
$message = 'Se ha realizado una nueva descarga de leads.';
$headers = 'From: navarrolucas4668@gmail.com' . "\r\n" .
           'Reply-To: navarrolucas4668@gmail.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();
mail($to, $subject, $message, $headers);

$conn->close();
?>
