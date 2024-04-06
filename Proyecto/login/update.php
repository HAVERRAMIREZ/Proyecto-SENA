<?php
	require 'config.php';
	if(empty($_SESSION['cedula']))
		header('Location: login.php');

	if(isset($_POST['update'])) {
		$errMsg = '';

		// Getting data from FROM
		$cedula = $_POST['cedula'];
		$contrasena = $_POST['contrasena'];
		$nombres = $_POST['nombres'];
		$apellidos = $_POST['apellidos'];
		$telefono = $_POST['telefono'];
		$passwordVarify = $_POST['passwordVarify'];

		if($contrasena != $passwordVarify)
			$errMsg = 'Error en la contraseña.';

		if($errMsg == '') {
			try {
		      $sql = "UPDATE residentes SET contrasena = :contrasena, nombres = :nombres, apellidos = :apellidos, telefono = :telefono WHERE cedula = :cedula";
		      $stmt = $connect->prepare($sql);                                  
		      $stmt->execute(array(
		        ':contrasena' => $contrasena,
				':nombres' => $nombres,
				':apellidos' => $apellidos,
				':telefono' => $telefono, 
		        ':cedula' => $_SESSION['cedula']
		      ));
				header('Location: update.php?action=updated');
				exit;

			}
			catch(PDOException $e) {
				$errMsg = $e->getMessage();
			}
		}
	}

	if(isset($_GET['action']) && $_GET['action'] == 'updated')
		$errMsg = 'Datos Actualizados Correctamente. <a href="logout.php">Salga</a> e ingrese de nuevo.';
?>

<html>
	<head>
		<title>Actualizar</title>
		<meta charset = "UTF-8">
		
	</head>
    <link rel="stylesheet" href="styleupdate.css">
<body>
	<div class="update-container">
		<form action="" method="post">
			Nombre Completo<br>
			<input class = 'ipt-form' type="text" name="nombres" value="<?php echo $_SESSION['nombres']; ?>" autocomplete="off" class="box"/><br>
			Apellido Completo<br>
			<input class = 'ipt-form' type="text" name="apellidos" value="<?php echo $_SESSION['apellidos']; ?>" autocomplete="off" class="box"/><br>
			Identificación<br>
			<input class = 'ipt-form' type="text" name="cedula" value="<?php echo $_SESSION['cedula']; ?>" disabled autocomplete="off" class="box"/><br>
			Telefono<br>
			<input class = 'ipt-form' type="text" name="telefono" value="<?php echo $_SESSION['telefono']; ?>" autocomplete="off" class="box"/><br>
			Contraseña<br>
			<input class = 'ipt-form' type="password" name="contrasena" value="<?php echo $_SESSION['contrasena'] ?>" class="box" /><br>
			Validar Contraseña<br>
			<input class = 'ipt-form' type="password" name="passwordVarify" value="<?php echo $_SESSION['contrasena'] ?>" class="box" /><br>
			<input class = 'ipt-btn' type="submit" name='update' value="Actualizar" class='submit'/><br />
			<?php
				if(isset($errMsg)){
					echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';}
			?>
		</form>
	</div>
</body>
</html>
