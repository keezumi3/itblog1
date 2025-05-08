<?php
// Увімкнення відображення помилок для налагодження
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Початок сесії
session_start();
$login = 'admin';
$pass = '123';

// Перевірка авторизації
if ($_SESSION["login"] !== $login || $_SESSION["password"] !== $pass) {
    header('location: ../login/index.php');
    exit;
}

// Підключення до бази даних
include_once '../include/config.php';

try {
    // Обробка завантаження файлу
    $fileName = "img/no-image.jpg"; // Значення за замовчуванням
    
    if (isset($_FILES["image"]) && $_FILES["image"]["tmp_name"] != "") {
        // Перевірка, чи це дійсно зображення
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            // Створення унікального імені файлу
            $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
            $newFileName = "img/" . time() . "." . $imageFileType;
            
            // Завантаження файлу
            if (move_uploaded_file($_FILES["image"]["tmp_name"], "../" . $newFileName)) {
                $fileName = $newFileName;
            } else {
                throw new Exception("Помилка при завантаженні файлу.");
            }
        } else {
            throw new Exception("Файл не є зображенням.");
        }
    }
    
    // Отримання даних з форми
    $title = isset($_POST["title"]) ? $_POST["title"] : "";
    $content = isset($_POST["content"]) ? $_POST["content"] : "";
    $datetime = isset($_POST["datetime"]) ? $_POST["datetime"] : date("Y-m-d");
    $category_id = isset($_POST["category_id"]) ? $_POST["category_id"] : 0;
    
    // Підготовка та виконання SQL-запиту з використанням mysqli
    $title = mysqli_real_escape_string($conn, $title);
    $content = mysqli_real_escape_string($conn, $content);
    $fileName = mysqli_real_escape_string($conn, $fileName);
    $datetime = mysqli_real_escape_string($conn, $datetime);
    $category_id = mysqli_real_escape_string($conn, $category_id);
    
    $sql = "INSERT INTO news (title, content, image, datetime, category_id) 
            VALUES ('$title', '$content', '$fileName', '$datetime', '$category_id')";
    
    if (!mysqli_query($conn, $sql)) {
        throw new Exception("Помилка SQL: " . mysqli_error($conn));
    }
    
    // Перенаправлення на сторінку адмін-панелі
    header("Location: index.php");
    exit;
    
} catch (Exception $e) {
    // Запис помилки в журнал
    error_log("Помилка: " . $e->getMessage());
    
    // Відображення повідомлення про помилку
    echo "Помилка: " . $e->getMessage();
    exit;
}
?>