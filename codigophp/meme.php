<?php session_start(); 
require("conecta.php");?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imagen modificada</title>
</head>
<body>
<?php

    $id = $_POST["id"];
    $cajas =$_POST["cajas"];
    $arrayCajas = array();
    for ($i = 1; $i <= $cajas; $i++) {
        array_push($arrayCajas, array("text" => $_POST["caja$i"], "color" => "#D6FFF6"));
    }

    //url for meme creation
    $url = 'https://api.imgflip.com/caption_image';


    //The data you want to send via POST
    $fields = array(
            "template_id" => $id,
            "username" => "fjortegan",
            "password" => "pestillo",
            "boxes" => $arrayCajas
        );


    //url-ify the data for the POST
    $fields_string = http_build_query($fields);

    //open connection
    $ch = curl_init();

    //set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_POST, true);
    curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

    //So that curl_exec returns the contents of the cURL; rather than echoing it
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 

    //execute post
    $result = curl_exec($ch);
    curl_close($ch);

    //decode response
    $data = json_decode($result, true);


    //if success show image
    if($data["success"]) {
        print($_SESSION["user"]);
        $nameMeme = $_SESSION["user"].date("dmyHis").".jpeg";
        file_put_contents("memes/$nameMeme",file_get_contents($data["data"]["url"]));
        echo "<img src='" . $data["data"]["url"] . "'>";
        
        // prepara la sentencia SQL. Le doy un nombre a cada dato del formulario 
        $sql = "INSERT INTO created_memes (name,route,id_user) values (:name,:route,:id_user)";
        // asocia valores a esos nombres
        $datos = array("name" => $nameMeme,
                    "route"=>"memes/$nameMeme",
                    "id_user"=>$_SESSION["id"]
                    );
        // comprueba que la sentencia SQL preparada está bien 
        $stmt = $conn->prepare($sql);
        // ejecuta la sentencia usando los valores
        if($stmt->execute($datos) != 1) {
            print("No se pudo dar de alta");
            exit(0);
        }
    }
    ?>
</body>
    <a href="index.php">Volver a inicio</a>
</body>
</html>