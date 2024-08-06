<?php
require 'Controladores/filtros.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTables with PHP</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
</head>
<body>
    <div class="container">
        <h2>Filtrar Datos con DataTables</h2>
        <div>
            <form method="get" action="">
                <label for="country">Country:</label>
                <input type="text" id="country" name="country" value="<?= htmlspecialchars($country) ?>">
                <label for="cnae">CNAE:</label>
                <input type="text" id="cnae" name="cnae" value="<?= htmlspecialchars($cnae) ?>">
                <label for="role">Role:</label>
                <input type="text" id="role" name="role" value="<?= htmlspecialchars($role) ?>">
                <label for="industry">Industry:</label>
                <input type="text" id="industry" name="industry" value="<?= htmlspecialchars($industry) ?>">
                <button type="submit">Filtrar</button>
                <a href="index.php" class="btn btn-secondary">Resetear</a>
                <button type="submit" formaction="Controladores/export_csv.php">Submit</button>
            </form>
        </div>

        <table id="tabla" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>emailStatus</th>
                    <th>email</th>
                    <th>fullName</th>
                    <th>firstName</th>
                    <th>lastName</th>
                    <th>linkedinUrl</th>
                    <th>companyName</th>
                    <th>companyWebsite</th>
                    <th>icebreaker</th>
                    <th>country</th>
                    <th>location</th>
                    <th>industry</th>
                    <th>companyProfileUrl</th>
                    <th>civility</th>
                    <th>Role</th>
                    <th>CNAE</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['emailStatus']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['fullName']) ?></td>
                            <td><?= htmlspecialchars($row['firstName']) ?></td>
                            <td><?= htmlspecialchars($row['lastName']) ?></td>
                            <td><?= htmlspecialchars($row['linkedinUrl']) ?></td>
                            <td><?= htmlspecialchars($row['companyName']) ?></td>
                            <td><?= htmlspecialchars($row['companyWebsite']) ?></td>
                            <td><?= htmlspecialchars($row['icebreaker']) ?></td>
                            <td><?= htmlspecialchars($row['country']) ?></td>
                            <td><?= htmlspecialchars($row['location']) ?></td>
                            <td><?= htmlspecialchars($row['industry']) ?></td>
                            <td><?= htmlspecialchars($row['companyProfileUrl']) ?></td>
                            <td><?= htmlspecialchars($row['civility']) ?></td>
                            <td><?= htmlspecialchars($row['Role']) ?></td>
                            <td><?= htmlspecialchars($row['CNAE']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="16">No se encontraron resultados</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#tabla').DataTable();
    });
    </script>
</body>
</html>

<?php
$conn->close();
?>
