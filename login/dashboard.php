<?php
    session_start();

    // Configuración de la base de datos
    $host = 'localhost';
    $dbname = 'smart_locker';
    $username = 'root';
    $password = '';

    // Crear una instancia de la clase PDO para la conexión a la base de datos
    try {
        $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        exit();
    }

    // Verificar si el usuario está logueado
    if (!isset($_SESSION['nombres'])) {
        header('Location: login.php');
        exit();
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
            <div class="menu-item">
                <a href="crud_tipo_paquete.php">Tipos de Paquete</a>
            </div>
        </div>

        <div class="main-panel">
            <?php if (isset($errMsg)): ?>
                <div style="text-align:center;font-size:17px;"><?php echo $errMsg; ?></div>
            <?php endif; ?>

            <div class="user-top">
                <p>Bienvenido <?php echo htmlspecialchars($_SESSION['nombres']); ?></p>
                <div>
                    <button class="crud-button" onclick="location.href='update.php'">Actualizar</button>
                    <button class="crud-button" onclick="location.href='logout.php'">Salir</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


