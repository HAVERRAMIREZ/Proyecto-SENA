<?php
    include_once("config.php");

    if(isset($_POST['submit_create'])) {
        $tipo = $_POST['tipo'];
        $sql = "INSERT INTO tipo_paquete (tipo) VALUES (:tipo)";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':tipo', $tipo);
        $query->execute();
        header("Location: dashboard.php");
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Tipo de Paquete</title>
    <link rel="stylesheet" href="styledashboard.css">
</head>
<body>
    <div class="create-form">
        <h2>Crear Nuevo Tipo de Paquete</h2>
        <form method="post" action="">
            <input type="text" name="tipo" placeholder="Tipo de Paquete" required>
            <button type="submit" name="submit_create">Crear</button>
        </form>
    </div>
</body>
</html>
