<?php

	require 'config.php';

	if(isset($_POST['login'])) {
		$errMsg = '';

		// Get data from FORM
		$cedula = $_POST['username'];
		$contrasena = $_POST['password'];

		if(empty($cedula)) { // Usar empty() en lugar de == ''
			$errMsg = 'Ingrese un usuario';
		}
		if(empty($contrasena)) { // Usar empty() en lugar de == ''
			$errMsg = 'Ingrese una contraseña';
		}

		if($errMsg == '') {
			try {
				$stmt = $connect->prepare('SELECT cedula, contrasena, nombres, apellidos, telefono FROM residentes WHERE cedula = :cedula');
				$stmt->execute(array(
					':cedula' => $cedula
					));
				$data = $stmt->fetch(PDO::FETCH_ASSOC);
				

				if($data === false) { // Usar === para una comparación estricta
					$errMsg = "Usuario $cedula no encontrado.";
				} else {
					if($contrasena === $data['contrasena']) { // Verificar la contraseña
						$_SESSION['cedula'] = $data['cedula'];
						$_SESSION['contrasena'] = $data['contrasena'];
						$_SESSION['nombres'] = $data['nombres'];
						$_SESSION['apellidos'] = $data['apellidos'];
						$_SESSION['telefono'] = $data['telefono'];
					
						echo "<script>window.location.replace('dashboard.php');</script>";
						exit;
					} else {
						$errMsg = 'Contraseña incorrecta.';
					}
				}
			}
			catch(PDOException $e) {
				$errMsg = $e->getMessage();
			}
		}
	}
?>

<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar sesión</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="login-container">
  <img src="assets/Recursos/User.webp" alt="Ícono de Usuario" class="user-icon"/>
    <h1>Iniciar sesión</h1>
    <form method="post">
      
	<div class="input-wrapper">
         <input class="ipt-form box" type="text" name="username" id="username" placeholder=" " value="<?php if(isset($_POST['username'])) echo htmlspecialchars($_POST['username']); ?>" autocomplete="off" required/>
         <label for="username">Usuario</label>
      </div>
     
		 <div class="input-wrapper">
        	 <input class="ipt-form box" type="password" name="password" id="password" placeholder=" " autocomplete="off" required/>
       		 <label for="password">Contraseña</label>
		 </div>
	  
		 <div>
			 <input class="ipt-btn" type="submit" name="login" value="Ingresar"/>
		 </div>

</div>
      
    </form>
    <?php
    if(isset($errMsg)){
      echo '<div style="color:#E5E7E9;text-align:center;font-size:30px;">'.$errMsg.'</div>';
    }
    ?>
  </div>
</body>
</html>
