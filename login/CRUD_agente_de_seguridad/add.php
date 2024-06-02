<?php
include_once("config.php");

if (isset($_POST['Submit'])) {
    $Nombres = isset($_POST['nombres']) ? $_POST['nombres'] : '';
    $Apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : '';
    $Cedula = isset($_POST['cedula']) ? $_POST['cedula'] : '';
    $contraseña = isset($_POST['contraseña']) ? $_POST['contraseña'] : '';

    // Verificar si alguno de los campos está vacío
    if (empty($Nombres) || empty($Apellidos) || empty($Cedula) || empty($contraseña)) {
        if (empty($Nombres)) {
            echo "<font color='red'>Campo: nombre está vacío.</font><br/>";
        }
        if (empty($Apellidos)) {
            echo "<font color='red'>Campo: apellido está vacío.</font><br/>";
        }
        if (empty($Cedula)) {
            echo "<font color='red'>Campo: cedula está vacío.</font><br/>";
        }
        if (empty($contraseña)) {
            echo "<font color='red'>Campo: contraseña está vacío.</font><br/>";
        }
        echo "<br/><a href='javascript:self.history.back();'>Volver</a>";
    } else {
        try {
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
                $sql = "INSERT INTO agente_de_seguridad (nombres, apellidos, cedula, contrasena) VALUES(:nombres, :apellidos, :cedula, :contrasena)";
                $query = $dbConn->prepare($sql);
                $query->bindParam(':nombres', $Nombres);
                $query->bindParam(':apellidos', $Apellidos);
                $query->bindParam(':cedula', $Cedula);
                $query->bindParam(':contrasena', $contraseña);
                $query->execute();

                echo "<font color='green'>Registro agregado correctamente.</font><br/>";
                echo "<br/><a href='index.php'>Ver todos los registros</a>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>


