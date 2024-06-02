<?php
include_once("config.php");
$result = $dbConn->query("SELECT * FROM tipo_paquete ORDER BY id ASC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Tipos de Paquete</title>
    <link rel="stylesheet" href="style.css">        
</head>
<body>
    <a href="add.html" class="btn-lila">Agregar Tipo de Paquete</a><br/><br/>
    <div class="container">
        <table class="table">
            <thead>
                <tr class="header-row">
                    <th>ID</th>
                    <th>Tipo de Paquete</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>".$row['id']."</td>";
                    echo "<td>".$row['tipo']."</td>";
                    echo "<td><a href=\"edit.php?id={$row['id']}\" class=\"edit-btn\">Editar</a> | <a href=\"delete.php?id={$row['id']}\" class=\"delete-btn\" onClick=\"return confirm('¿Está seguro de eliminar el registro?')\">Eliminar</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="button-container">
        <button onclick="window.location.href='../dashboard.php'" class="reg-btn">Regresar</button>
    </div>
</body>
</html>
