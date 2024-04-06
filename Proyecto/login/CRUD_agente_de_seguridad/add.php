<?php
    include_once("config.php");

    if (isset($_POST['Submit'])) {
        $Nombres = $_POST['Nombres'];
        $Apellidos = $_POST['Apellidos'];
        $ID = $_POST['ID'];
        $Cedula = $_POST['Cedula'];
        $Contraseña = $_POST['Contraseña'];

        // Verificar si la cédula ya existe en la base de datos
        $query_check = $dbConn->prepare("SELECT COUNT(*) FROM agente_de_seguridad WHERE Cedula = :Cedula");
        $query_check->bindParam(':Cedula', $Cedula);
        $query_check->execute();
        $count = $query_check->fetchColumn();

        if ($count > 0) {
            echo "<font color='red'>La cédula ya existe en la base de datos.</font><br/>";
            echo "<br/><a href='javascript:self.history.back();'>Volver</a>";
        } else {
            // Insertar el nuevo registro
            $sql = "INSERT INTO Agente_de_seguridad(nombres, apellidos, cedula, contrasena) VALUES(:Nombres, :Apellidos, :Cedula, :Contraseña)";
            $query = $dbConn->prepare($sql);
            $query->bindparam(':Nombres', $Nombres);
            $query->bindparam(':Apellidos', $Apellidos);
            $query->bindparam(':Cedula', $Cedula);
            $query->bindparam(':Contraseña', $Contraseña);
            $query->execute();

            echo "<font color='green'>Registro agregado correctamente.</font>";
            echo "<br/><a href='index.php'>Ver todos los registros</a>";
        }
    }
?>

