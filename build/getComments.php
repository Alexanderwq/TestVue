<?php


include("connect.php");

            $result = mysqli_query($connect, "SELECT * FROM `comment` ORDER BY `id` DESC"); // запрос данных с бд 
            
            $data = array();
                while($row = mysqli_fetch_assoc($result)){
                    $data[] = $row; 
                };
            
            echo json_encode($data);
            

            
?>