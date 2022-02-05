<?php
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type");
    include("connect.php");
    $postData = file_get_contents('php://input');
    $data = json_decode($postData, true); 
    
  
    // Удаление с БД
    $sql = "DELETE FROM `comment` WHERE id='" . $data . "'";
    $result = mysqli_query($connect, $sql);
    if ($result == false) {
        print("произошла ошибка при удалении");
    }
?>