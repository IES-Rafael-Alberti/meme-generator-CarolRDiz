<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear meme</title>
    <link rel="stylesheet" href="estilos/estilos.css?v=<?php echo(rand()); ?>"/>
 </head>
<body>

<?php
echo "<img class='imglist' src='$_GET[url]'><br>";
$id = $_GET["id"];
$url = $_GET["url"];
$cajas = $_GET["cajas"];
?>
<form action="meme.php" method="post">
    <input type="hidden" name="id" value=<?php echo "$id";?>>
    <input type="hidden" name="url" value=<?php echo "$url";?>>
    <input type="hidden" name="cajas" value=<?php echo "$cajas";?>>
    <?php
        for ($i = 1; $i <= $cajas; $i++) {
            echo "<label for='caja$i'>Texto$i: </label>";
            echo "<input type='text' name='caja$i' id='caja$i' value='Texto $i'>";
            echo "<label for='color$i'>Color$i: </label>";
            echo "<input type='color' name='color$i' id='color$i' value='Color $i'>";
        }
    ?>
    <input type="submit" class='boton' value="Crear meme" action="meme.php">
</form>
</body>