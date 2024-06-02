<?php
    // Configuración de la base de datos
    $host = 'localhost';
    $dbname = 'nombre_basedatos';
    $username = 'nombre_usuario';
    $password = 'contraseña';

    // Crear una instancia de la clase PDO para la conexión a la base de datos
    try {
        $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
    }
?>


<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="styledashboard.css">
</head>
<body>
    <div class="dashboard-wrapper">

        <div class="sidebar">
            <div class="menu-item">
                <a href="CRUD_agente_de_seguridad/index.php">Agentes de Seguridad</a>
            </div>
            <div class="menu-item">
                <a href="CRUD_propietarios/index.php">Propietarios</a>
            </div>
            <div class="menu-item">
                <a href="CRUD_residentes/index.php">Residentes</a>
            </div>
            <div class="menu-item">
                <a href="CRUD_visitantes/index.php">Visitantes </a>
            </div>
        </div>

        <div class="main-panel">
            <?php
                if(isset($errMsg)){
                    echo '<div style="text-align:center;font-size:17px;">'.$errMsg.'</div>';
                }
            ?>

            <div class="user-top">
                <p>Bienvenido <?php echo $_SESSION['nombres']; ?></p>
                <div>
                    <button class="crud-button" onclick="location.href='update.php'">Actualizar</button>
                    <button class="crud-button" onclick="location.href='logout.php'">Salir</button>
                </div>
            </div>

            <div class="tipo-paquete">
                <h2>Tipos de Paquete</h2>
                <ul>
                    <?php foreach ($tipos_paquete as $tipo): ?>
                        <li><?php echo $tipo['tipo']; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>
    </div>
</body>
</html>
