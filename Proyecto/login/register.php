<?php
	require 'config.php';

	if(isset($_POST['register'])) {
		$errMsg = '';

		// Get data from FROM
		$nombres = $_POST['nombres'];
		$apellidos = $_POST['apellidos'];
		$cedula = $_POST['cedula'];
		$contrasena = $_POST['contrasena'];
		$telefono = $_POST['telefono'];

		if(empty($nombres))
			$errMsg = 'Ingrese un Nombre';
		if(empty($apellidos))
			$errMsg = 'Ingrese un Apellido';
		if(empty($cedula))
			$errMsg = 'Ingrese un Usuario';
		if(empty($contrasena))
			$errMsg = 'Ingrese una Contraseña';
		if(empty($telefono))
			$errMsg = 'Ingrese un Telefono';

		if($errMsg == ''){
			try {
				$stmt = $connect->prepare('INSERT INTO residentes (nombres, apellidos, cedula, contrasena, telefono) VALUES (:nombres, :apellidos, :cedula, :contrasena, :telefono)');
				$stmt->execute(array(
					':nombres' => $nombres,
					':apellidos' => $apellidos,
					':cedula' => $cedula,
					':contrasena' => $contrasena,
					':telefono' => $telefono
				));

				header('Location: register.php?action=joined');
				exit;
			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
	}

	if(isset($_GET['action']) && $_GET['action'] == 'joined') {
		$errMsg = 'Registro Exitoso!!. Ahora puede Ingresar <a href="login.php">Ingreso</a>';
	}
?>

<html>
	<head><title>Registro</title></head>
	<style>
	html, body {
		margin: 1px;
		border: 0;
	}
	</style>
<body>
	<div style="margin: 15px">
		<div align="center">
			<div style=" border: solid 1px #079B96; " align="center">	
				<b>Registrate</b>
				<div style="margin: 15px">
					<form action="" method="post">
						<input type="text" name="nombres" placeholder="Nombre Completo" value="<?php if(isset($_POST['nombres'])) echo $_POST['nombres'] ?>" autocomplete="off" class="box"/><br /><br />
						<input type="text" name="apellidos" placeholder="Apellido Completo" value="<?php if(isset($_POST['apellidos'])) echo $_POST['apellidos'] ?>" autocomplete="off" class="box"/><br /><br />
						<input type="text" name="cedula" placeholder="Usuario" value="<?php if(isset($_POST['cedula'])) echo $_POST['cedula'] ?>" autocomplete="off" class="box"/><br /><br />
						<input type="password" name="contrasena" placeholder="Contraseña" value="<?php if(isset($_POST['password'])) echo $_POST['password'] ?>" class="box" /><br/><br />
						<input type="text" name="telefono" placeholder="Telefono" value="<?php if(isset($_POST['telefono'])) echo $_POST['telefono'] ?>" class="box" /><br/><br />
						<input type="submit" name='register' value="Registrarse" class='submit'/><br />
					</form>
					<span><a href="index.php">Volver al inicio</a></span>
				</div>
			</div>
			<?php
					if(isset($errMsg)){
						echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
					}
			?>
		</div>
	</div>
</body>
</html>
