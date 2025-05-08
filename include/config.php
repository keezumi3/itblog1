<?php
    // Дані для підключення до бази даних на InfinityFree
    $servername = "sql210.byetcluster.com"; // Ваш MySQL сервер
    $username = "if0_38932072"; // Ваше ім'я користувача
    $password = "K2qJbScYr6"; // Ваш пароль
    $dbname = "if0_38932072_itblog"; // Назва вашої бази даних
    
    // Створення з'єднання
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    // Перевірка з'єднання
    if (mysqli_connect_errno()){
        echo 'Помилка підключення до БД ('.mysqli_connect_errno().')'.mysqli_connect_error();
        exit();
    }
    
    // Встановлення кодування
    mysqli_set_charset($conn, "utf8");
?>