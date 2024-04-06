
<?php 
include_once("config.php"); 

if(isset($_POST['update'])) {  
    $id = $_POST['id'];   
    $nombres = $_POST['Nombres']; 
    $Apellidos = $_POST['Apellidos']; 
    $ID = $_POST['id']; 
    $Cedula = $_POST['Cedula']; 

    if(empty($nombres) || empty($Apellidos) || empty($ID) || empty($Cedula)) {      
        if(empty($nombres)) { 
            echo "<font color='red'>Campo: Nombres está vacío.</font><br/>"; 
        }   
        if(empty($Apellidos)) { 
            echo "<font color='red'>Campo: Apellidos está vacío.</font><br/>"; 
        } 
        if(empty($ID)) { 
            echo "<font color='red'>Campo: ID está vacío.</font><br/>"; 
        }   
        if(empty($Cedula)) { 
            echo "<font color='red'>Campo: Cedula está vacío.</font><br/>"; 
        } 
    } else {  
        $sql = "UPDATE agente_de_seguridad SET nombres=:Nombres, apellidos=:Apellidos, id=:ID, cedula=:Cedula WHERE id=:id"; 
        $query = $dbConn->prepare($sql);     
        $query->bindparam(':id', $id); 
        $query->bindparam(':Nombres', $nombres); 
        $query->bindparam(':Apellidos', $Apellidos); 
        $query->bindparam(':ID', $ID); 
        $query->bindparam(':Cedula', $Cedula); 
        $query->execute();   
        header("Location: index.php"); 
    } 
} 

$id = $_GET['id']; 
$sql = "SELECT * FROM agente_de_seguridad WHERE id=:id"; 
$query = $dbConn->prepare($sql); 
$query->execute(array(':id' => $id)); 
while($row = $query->fetch(PDO::FETCH_ASSOC)) { 
    $nombres = $row['nombres']; 
    $Apellidos = $row['apellidos']; 
    $ID = $row['id']; 
    $Cedula = $row['cedula'];  
} 
?> 

<html> 
<head>  
    <title>Editar Datos</title> 
</head> 

<body> 
    <a href="index.php">Inicio</a> 
    <link rel="stylesheet" href="style.css">

    <br/><br/> 
    <div class = "container">
    <form name="form1" method="post" action="edit.php"> 
        <table border="0"> 
            <tr>  
                <td>Nombres</td> <br>
                <td><input  class= "ipt-form" type="text" name="Nombres" value="<?php echo $nombres;?>"></td> 
            </tr> 
            <tr>  
                <td>Apellidos</td> <br>
                <td><input  class= "ipt-form" type="text" name="Apellidos" value="<?php echo $Apellidos;?>"></td> 
            </tr> 
            <tr>  
                <td>ID</td> <br>
                <td><input  class= "ipt-form" type="text" name="ID" disabled value="<?php echo $ID;?>"></td> 
            </tr> 
            <tr>  
                <td>Cedula</td> <br>
                <td><input  class= "ipt-form" type="text" name="Cedula" value="<?php echo $Cedula;?>"></td> 
            </tr> 
            <tr> 
                <td><input type="hidden" name="id" value="<?php echo $id;?>"></td> 
                <td><input type="submit" name="update" value="Editar"></td> 
            </tr> 
        </table> 
    </form> 
</body> 
</html> 

