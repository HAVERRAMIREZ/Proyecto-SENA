<?php
    include("config.php");
    $ID = $_GET['id'];
    $sql = "DELETE FROM agente_de_seguridad WHERE id=:id";
    $query = $dbConn->prepare($sql);
    $query->execute(array(':id' => $ID));
    header("Location:index.php");
?>