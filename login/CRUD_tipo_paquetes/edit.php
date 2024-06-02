<?php
include_once("config.php");

if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $tipo = $_POST['tipo'];

    if(empty($tipo)) {
        echo "<font color='red'>El campo tipo está vacío.</font><br/>";
    } else {
        $sql = "UPDATE tipo_paquete SET tipo=:tipo WHERE id=:id";
        $query = $dbConn->prepare($sql);
        $query->bindparam(':id', $id);
        $query->bindparam(':tipo', $tipo);
        $query->execute();
        header("Location: index.php"); // Redireccionar a la página principal después de la actualización
    }
}

$id = $_GET['id'];
$sql = "SELECT * FROM tipo_paquete WHERE id=:id";
$query = $dbConn->prepare($sql);
$query->execute(array(':id' => $id));
$row = $query->fetch(PDO::FETCH_ASSOC);
$tipo = $row['tipo'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Tipo de Paquete</title>
</head>
<body>
    <a href="index.php">Inicio</a>
    <br/><br/>
    <form name="form1" method="post" action="update_tipo_paquete.php">
        <table border="0">
            <tr>
                <td>ID</td>
                <td><input type="text" name="id" value="<?php echo $id; ?>" readonly></td>
            </tr>
            <tr>
                <td>Tipo de Paquete</td>
                <td><input type="text" name="tipo" value="<?php echo $tipo; ?>"></td>
            </tr>
            <tr>
                <td><input type="submit" name="update" value="Actualizar"></td>
            </tr>
        </table>
    </form>
</body>
</html>
