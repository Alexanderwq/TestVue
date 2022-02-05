<?php
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type");
    include("connect.php");
    $postData = file_get_contents('php://input');
    $data = json_decode($postData, true); 
    var_dump($data);

    
    // отправка данных в БД
    mysqli_query($connect, "INSERT INTO `comment` VALUES ('" . $data["id"] . "', '" . $data["author"] . "', '" . $data["text"] . "', '" . $data["date"] . "', '" . $data["time"] . "')");
        
?>