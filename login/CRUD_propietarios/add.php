<html>
<head>
<meta charset="UTF-8">
<title>Adicionar Datos</title>
</head>
<body>
<?php
include_once("config.php");

if(isset($_POST['Submit'])) {
    $Nombres = $_POST['Nombres'];
    $Apellidos = $_POST['Apellidos'];
    $Cedula = $_POST['Cedula'];
    $Contraseña = $_POST['Contraseña'];

    if(empty($Nombres) || empty($Apellidos) || empty($Cedula) || empty($Contraseña)) {
        if(empty($Nombres)) {
            echo "<font color='red'>Campo: nombre está vacío.</font><br/>";
        }
        if(empty($Apellidos)) {
            echo "<font color='red'>Campo: apellido está vacío.</font><br/>";
        }
        if(empty($Cedula)) {
            echo "<font color='red'>Campo: cédula está vacío.</font><br/>";
        }
        if(empty($Contraseña)) {
            echo "<font color='red'>Campo: contraseña está vacío.</font><br/>";
        }
        echo "<br/><a href='javascript:self.history.back();'>Volver</a>";
    } else {
        // Verificar si la cédula ya existe en la base de datos
        $query_check = $dbConn->prepare("SELECT COUNT(*) FROM Agente_de_seguridad WHERE Cedula = :Cedula");
        $query_check->bindParam(':Cedula', $Cedula);
        $query_check->execute();
        $count = $query_check->fetchColumn();

        if ($count > 0) {
            echo "<font color='red'>La cédula ya existe en la base de datos.</font><br/>";
            echo "<br/><a href='javascript:self.history.back();'>Volver</a>";
        } else {
            // Insertar el nuevo registro
            $sql = "INSERT INTO Agente_de_seguridad (nombres, apellidos, cedula, contrasena) VALUES (:Nombres, :Apellidos, :Cedula, :Contraseña)";
            $query = $dbConn->prepare($sql);
            $query->bindParam(':Nombres', $Nombres);
            $query->bindParam(':Apellidos', $Apellidos);
            $query->bindParam(':Cedula', $Cedula);
            $query->bindParam(':Contraseña', $Contraseña);
            $query->execute();

            echo "<font color='green'>Registro agregado correctamente.</font>";
            echo "<br/><a href='index.php'>Ver todos los registros</a>";
        }
    }
}
?>
</body>
</html>
