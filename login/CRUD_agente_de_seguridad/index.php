<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agente_de_seguridad</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <a class="btn-lila" href="add.html">Agregar Agente de seguridad</a><br /><br />


    <div class="container">
        <table class="table">
            <tr class="header-row">
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>ID</th>
                <th>Cedula</th>
                <th>Contraseña</th>
                <th>Acciones</th>
            </tr>

            <div class="button-container">
                <button onclick="window.location.href='../dashboard.php'" class="reg-btn">Regresar</button>
            </div>

            <?php
            include_once("config.php");
            $result = $dbConn->query("SELECT * FROM agente_de_seguridad ORDER BY id ASC");
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['nombres'] . "</td>";
                echo "<td>" . $row['apellidos'] . "</td>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['cedula'] . "</td>";
                echo "<td>" . $row['contrasena'] . "</td>";
                echo "<td><a href=\"edit.php?id=$row[id]\" class=\"edit-btn\">Editar</a> | <a href=\"delete.php?id=$row[id]\" class=\"delete-btn\" onClick=\"return confirm('¿Está seguro de eliminar el registro?')\">Eliminar</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>

