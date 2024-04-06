<?php
include("config.php");
$id = $_GET['id'];
$sql = "DELETE FROM residentes WHERE id=:id";
$query = $dbConn->prepare($sql);
$query->execute(array(':id' => $id));
header("Location:index.php");
?>