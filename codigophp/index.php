<?php
require("testlogin.php");
require("conecta.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página principal</title>
    <link rel="stylesheet" href="estilos/estilos.css?v=<?php echo(rand()); ?>"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header>
        <img id ='logo'src="imagenes/logo.png" alt="Logo">
        <h1>MemeGenerator</h1>
        <?php
        $name = $_SESSION['user'];
        print("<p id='nombre_usuario'>".$_SESSION['user']."</p>");
        ?> 
        <a href='logout.php'>Cerrar sesión</a>
    </header>
    <main>
<?php
    $memes = $conn->query("Select * FROM created_memes WHERE id_user = (SELECT id FROM users WHERE name = '$name')");
    if($memes->rowCount() == 0) {
        print("<p>No tienes memes</p>");
    }
    else{
        print("<section class='memes'>");
        while($meme = $memes->fetchObject()){
            print("<article class='meme'>");
            print("<img width = '200px' src='".$meme->route."' alt='".$meme->name."'>");
            print("<p>".$meme->name."</p>");
            print("<a class='fa-solid fa-trash-can'href='borrarmeme.php?ruta=".$meme->route."'></a>");
            print("</article>");
        }
        print("</section>");
    }
?>  
    <a class="boton" href='listadomemes.php'>Crear un meme</a>
    <main>
    <footer>
        <a href="phpinfo.php">phpinfo()</a>
        <a href="xdebug_info.php">xdebug_info()</a>
    </footer>
</body>
</html>
