<?php
include_once("config.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM tipo_paquete WHERE id=:id";
    $query = $dbConn->prepare($sql);
    $query->execute(array(':id' => $id));
    header("Location: index.php"); // Redireccionar a la página principal después de eliminar
}
?>
