<?php
if(isset($_POST['name'])) {

    require("conecta.php");

    // recupera los datos del formulario
    $name = $_POST["name"];
    $pwd = $_POST["pwd"];
    //$sql = "INSERT INTO usuario (nombre, edad, foto) values ('$nombre', $edad, '$foto')";
    
    // prepara la sentencia SQL. Le doy un nombre a cada dato del formulario 
    $sql = "INSERT INTO users (name,pwd) values (:name,:pwd)";
    // asocia valores a esos nombres
    $datos = array("name" => $name,
                    "pwd" => $pwd
                  );
    // comprueba que la sentencia SQL preparada está bien 
    $stmt = $conn->prepare($sql);
    // ejecuta la sentencia usando los valores
    if($stmt->execute($datos) != 1) {
        print("No se pudo dar de alta");
    }
    else{
        header("Location: login.php");
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <h1>Registrarse</h1>
<form action="" method="post" enctype="multipart/form-data">
    <label for="name">Nombre: </label>
    <input type="text" name="name" id="name">
    <label for="pwd">Nombre: </label>
    <input type="password" name="pwd" id="pwd">
    <input type="submit" value="Enviar">
</form>    
</body>
</html>