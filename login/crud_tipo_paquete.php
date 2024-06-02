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

    // Inicializar la variable de tipos de paquete
    $tipos_paquete = [];

    // Obtener los tipos de paquete desde la base de datos
    try {
        $stmt = $dbConn->prepare("SELECT * FROM tipo_paquete");
        $stmt->execute();
        $tipos_paquete = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        $errMsg = "Error al obtener los tipos de paquete: " . $e->getMessage();
    }

    // Manejar el formulario de adición de tipo de paquete
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_tipo'])) {
        $tipo = $_POST['tipo'];

        // Insertar nuevo tipo de paquete
        try {
            $stmt = $dbConn->prepare("INSERT INTO tipo_paquete (tipo) VALUES (:tipo)");
            $stmt->bindParam(':tipo', $tipo);
            $stmt->execute();
            header('Location: crud_tipo_paquete.php');
            exit();
        } catch(PDOException $e) {
            $errMsg = "Error al adicionar el tipo de paquete: " . $e->getMessage();
        }
    }

    // Manejar la eliminación de tipo de paquete
    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];

        // Eliminar tipo de paquete
        try {
            $stmt = $dbConn->prepare("DELETE FROM tipo_paquete WHERE id = :id");
            $stmt->bindParam(':id', $delete_id);
            $stmt->execute();
            header('Location: crud_tipo_paquete.php');
            exit();
        } catch(PDOException $e) {
            $errMsg = "Error al eliminar el tipo de paquete: " . $e->getMessage();
        }
    }

    // Manejar el formulario de edición de tipo de paquete
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_tipo'])) {
        $id = $_POST['id'];
        $tipo = $_POST['tipo'];

        // Actualizar tipo de paquete
        try {
            $stmt = $dbConn->prepare("UPDATE tipo_paquete SET tipo = :tipo WHERE id = :id");
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            header('Location: crud_tipo_paquete.php');
            exit();
        } catch(PDOException $e) {
            $errMsg = "Error al actualizar el tipo de paquete: " . $e->getMessage();
        }
    }

    // Obtener datos del tipo de paquete para edición
    $edit_tipo_paquete = null;
    if (isset($_GET['edit_id'])) {
        $edit_id = $_GET['edit_id'];

        // Obtener tipo de paquete
        try {
            $stmt = $dbConn->prepare("SELECT * FROM tipo_paquete WHERE id = :id");
            $stmt->bindParam(':id', $edit_id);
            $stmt->execute();
            $edit_tipo_paquete = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            $errMsg = "Error al obtener el tipo de paquete: " . $e->getMessage();
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Tipo de Paquete</title>
    <link rel="stylesheet" href="styledashboard.css">
    <link rel="stylesheet" href="styleupdate.css">
</head>
<body>
    <div class="dashboard-wrapper">
        <div class="main-panel">
            <?php if (isset($errMsg)): ?>
                <div style="text-align:center;font-size:17px;"><?php echo $errMsg; ?></div>
            <?php endif; ?>

            <div class="user-top">
                <p>Bienvenido <?php echo htmlspecialchars($_SESSION['nombres']); ?></p>
                <div>
                    <button class="crud-button" onclick="location.href='update.php'">Actualizar</button>
                    <button class="crud-button" onclick="location.href='logout.php'">Salir</button>
                    <button class="crud-button" onclick="location.href='dashboard.php'">Regresar al Dashboard</button>
                </div>
            </div>

            <div class="tipo-paquete">
                <h2>Tipos de Paquete</h2>
                <div class="button-container">
                    <button onclick="document.getElementById('addTipoPaqueteForm').style.display='block'" class="crud-button">Adicionar Tipo de Paquete</button>
                </div>
                <div class="container">
                    <table class="table">
                        <thead>
                            <tr class="header-row">
                                <th>ID</th>
                                <th>Tipo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($tipos_paquete)): ?>
                                <?php foreach ($tipos_paquete as $tipo): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($tipo['id']); ?></td>
                                        <td><?php echo htmlspecialchars($tipo['tipo']); ?></td>
                                        <td>
                                            <a href="crud_tipo_paquete.php?edit_id=<?php echo $tipo['id']; ?>" class="edit-btn">Editar</a> | 
                                            <a href="crud_tipo_paquete.php?delete_id=<?php echo $tipo['id']; ?>" class="delete-btn" onClick="return confirm('¿Está seguro de eliminar el registro?')">Eliminar</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3">No hay tipos de paquete disponibles.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <?php if ($edit_tipo_paquete): ?>
                <div id="editTipoPaqueteForm" class="update-container">
                    <h2>Editar Tipo de Paquete</h2>
                    <form action="crud_tipo_paquete.php" method="post">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($edit_tipo_paquete['id']); ?>">
                        <input type="text" name="tipo" class="ipt-form" value="<?php echo htmlspecialchars($edit_tipo_paquete['tipo']); ?>" required>
                        <input type="submit" name="edit_tipo" class="ipt-btn" value="Actualizar">
                    </form>
                </div>
            <?php endif; ?>

            <div id="addTipoPaqueteForm" class="update-container" style="display: none;">
                <h2>Adicionar Tipo de Paquete</h2>
                <form action="crud_tipo_paquete.php" method="post">
                    <input type="text" name="tipo" class="ipt-form" placeholder="Tipo de Paquete" required>
                    <input type="submit" name="add_tipo" class="ipt-btn" value="Adicionar">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
