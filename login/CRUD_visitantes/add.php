<html>
<head>
<title>Adicionar Datos</title>
</head>
<body>
<?php
include_once("config.php");

// Siempre mostrar el botón de volver
echo "<a href='javascript:self.history.back();'>Volver</a><br/><br/>";

if(isset($_POST['Submit'])) {
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $telefono = $_POST['telefono'];
    $cedula = $_POST['cedula'];

    if(empty($nombres) || empty($apellidos) || empty($telefono) || empty($cedula)) {
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
        $sql = "INSERT INTO visitantes (nombres, apellidos, telefono, cedula) VALUES(:nombres, :apellidos, :telefono, :cedula)";
        $query = $dbConn->prepare($sql);
        $query->bindparam(':nombres', $nombres);
        $query->bindparam(':apellidos', $apellidos);
        $query->bindparam(':telefono', $telefono);
        $query->bindparam(':cedula', $cedula);
        $query->execute();
        
        echo "<font color='green'>Registro Agregado Correctamente.</font>";
        echo "Cantidad de Registros Agregados: ".$query->rowCount()."<br>";
        echo "<br/><a href='index.php'>Ver Todos los Registros</a>";
    }
}
?>
</body>
</html>
