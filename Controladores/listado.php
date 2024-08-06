<?php
include '../Modelos/conexion.php';

// Consultar todos los datos desde la base de datos
$sql = "SELECT emailStatus, email, fullName, firstName, lastName, linkedinUrl, companyName, companyWebsite, icebreaker, country, location, industry, companyProfileUrl, civility, Role, CNAE FROM tu_tabla";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);

$conn->close();
?>
