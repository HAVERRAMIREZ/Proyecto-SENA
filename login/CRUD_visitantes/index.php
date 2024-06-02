<?php
include_once("config.php");
$result = $dbConn->query("SELECT * FROM residentes ORDER BY id ASC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Residentes</title>
    <link rel="stylesheet" href="style.css">        
</head>
<body>
    <div class="button-container">
                <button onclick="window.location.href='../dashboard.php'" class="reg-btn">Regresar</button>
            </div>
    <a href="add.html" class="btn-lila">Adicionar residentes</a><br/><br/>
    <div class="container">
        <table class="table">
            <thead>
                <tr class="header-row">
                    <th>ID</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Telefono</th>
                    <th>Cedula</th>
                    <th>Acciones</th>
                </tr>
                
            </thead>
            
            <tbody>
                <?php
                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>".$row['id']."</td>";
                    echo "<td>".$row['nombres']."</td>";
                    echo "<td>".$row['apellidos']."</td>";
                    echo "<td>".$row['telefono']."</td>";
                    echo "<td>".$row['cedula']."</td>";
                    echo "<td><a href=\"edit.php?id={$row['id']}\" class=\"edit-btn\">Editar</a> | <a href=\"delete.php?id={$row['id']}\" class=\"delete-btn\" onClick=\"return confirm('¿Está seguro de eliminar el registro?')\">Eliminar</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    
</body>
</html>
