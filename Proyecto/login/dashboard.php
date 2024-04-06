<?php
	require 'config.php';
	if(empty($_SESSION['cedula'])) {
		header('Location: login.php');
		exit; 
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
                <a href="CRUD_visitantes/index.php">Administrador</a>
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


        </div>
    </div>
</body>
</html>
