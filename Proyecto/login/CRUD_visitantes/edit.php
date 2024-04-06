<?php
include_once("config.php");

if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $telefono = $_POST['telefono'];
    $cedula = $_POST['cedula'];

    if(empty($id) || empty($nombres) || empty($apellidos) || empty($telefono) || empty($cedula)) {
        if(empty($id)) {
            echo "<font color='red'>Campo: identificacion está vacío.</font><br/>";
        }
        if(empty($nombres)) {
            echo "<font color='red'>Campo: nombre está vacío.</font><br/>";
        }
        if(empty($apellidos)) {
            echo "<font color='red'>Campo: apellido está vacío.</font><br/>";
        }
        if(empty($telefono)) {
            echo "<font color='red'>Campo: telefono está vacío.</font><br/>";
        }
        if(empty($cedula)) {
            echo "<font color='red'>Campo: cedula está vacío.</font><br/>";
        }
        
    } else {
        $sql = "UPDATE administrador SET nombre=:nombres, apellido=:apellidos, telefono=:telefono, cedula=:cedula, WHERE id=:id";
        $query = $dbConn->prepare($sql);
        $query->bindparam(':id', $id);
        $query->bindparam(':nombre', $nombres);
        $query->bindparam(':apellido', $apellidos);
        $query->bindparam(':cedula', $cedula);
        $query->execute();
        header("Location: index.php");
    }
}
?>

<?php
$id = $_GET['id'];
$sql = "SELECT * FROM administrador WHERE id=:id";
$query = $dbConn->prepare($sql);
$query->execute(array(':id' => $id));
while($row = $query->fetch(PDO::FETCH_ASSOC))
{
 $id = $row['id'];
$nombres = $row['nombre'];
$apellidos = $row['apellidos'];
$cedula = $row['cedula'];
}
?>
<html>
<head>
<title>Edit Data</title>
</head>
<body>
<a href="index.php">Inicio</a>
<br/><br/>
<form name="form1" method="post" action="edit.php">
<table border="0">
<tr>
<td>Identificacion</td>
<td><input type="text" name="id"
value="<?php echo $id;?>"></td>
</tr>
<tr>
<td>nombres</td>
<td><input type="text" name="nombres" value="<?php echo
$nombres;?>"></td>
</tr>
<tr>
<td>apellidos</td>
<td><input type="text" name="apellidos" value="<?php echo
$apellidos;?>"></td>
</tr>
<tr>
<td>contraseña</td>
<td><input type="text" name="contraseña" value="<?php echo
$contrasena;?>"></td>
</tr>
<tr>
<td>cedula</td>
<td><input type="text" name="cedula" value="<?php echo
$cedula;?>"></td>
</tr>

<tr>
<td><input type="hidden" name="id" value=<?php echo
$_GET['id'];?>></td>
<td><input type="submit" name="update"
value="Editar"></td>
</tr>
</table>
</form>
</body>
</html>

