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
include_once '../include/function.php';

try {
    // Перевірка наявності ID
    if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
        throw new Exception("Невірний ID новини");
    }
    
    $id = $_POST['id'];
    
    // Отримання поточної новини
    $post = get_post_by_id($id);
    if (!$post) {
        throw new Exception("Новина не знайдена");
    }
    
    // Обробка завантаження файлу
    $fileName = $post['image']; // За замовчуванням залишаємо поточне зображення
    
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
    $id = mysqli_real_escape_string($conn, $id);
    $title = mysqli_real_escape_string($conn, $title);
    $content = mysqli_real_escape_string($conn, $content);
    $fileName = mysqli_real_escape_string($conn, $fileName);
    $datetime = mysqli_real_escape_string($conn, $datetime);
    $category_id = mysqli_real_escape_string($conn, $category_id);
    
    $sql = "UPDATE news SET 
            title = '$title', 
            content = '$content', 
            image = '$fileName', 
            datetime = '$datetime', 
            category_id = '$category_id' 
            WHERE id = '$id'";
    
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