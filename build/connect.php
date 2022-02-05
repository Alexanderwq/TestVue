<?php

    $connect = mysqli_connect("build", "root", "", "mydb");

    // Проверка на подключение к БД

    if ($connect == false){
        echo "Не удалось подключиться к БД";
        exit();
    }
?>