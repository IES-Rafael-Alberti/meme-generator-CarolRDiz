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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<?php
    $name = $_SESSION['user'];
    $memes = $conn->query("Select * FROM created_memes WHERE id_user = (SELECT id FROM users WHERE name = '$name')");
    //Select * FROM created_memes WHERE id_user = (SELECT id FROM users WHERE name = $_SESSION['user'])
    if($memes->rowCount() == 0) {
        print("<p>No tienes memes</p>");
    }
    print($_SESSION['user']);
    print("<table class='memes'>");
    while($meme = $memes->fetchObject()) {
        print("<tr>");
        print("<td>");
        print("<a href='borrarmeme.php?id=".$user["id"]."'><i class='fa-solid fa-trash-can'></i>");
        print("</td>");
        print("<td>");
        print($meme->name);
        print("</td>");
        print("</tr>");
    }
    print("</table>");
?>
    <a href="phpinfo.php">phpinfo()</a>
    <a href="xdebug_info.php">xdebug_info()</a>
</body>
</html>
