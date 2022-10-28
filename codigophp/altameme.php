<?php
echo "<img width=50 src='$_GET[url]'><br>";
$id = $_GET["id"];
$url = $_GET["url"];
$cajas = $_GET["cajas"];
?>
<form action="meme.php" method="post">
    <input type="hidden" name="id" value=<?php echo "$id";?>>
    <input type="hidden" name="url" value=<?php echo "$url";?>>
    <input type="hidden" name="cajas" value=<?php echo "$cajas";?>>
    <?php
        for ($i = 1; $i <= $_GET["cajas"]; $i++) {
            echo "<input type='text' name='caja$i' id='caja$i' value='Texto $i'>";
        }
    ?>
    <input type="submit" value="Create a meme" action="meme.php">
</form>