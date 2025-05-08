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
    if (!isset($_GET['post_id']) || !is_numeric($_GET['post_id'])) {
        throw new Exception("Невірний ID новини");
    }
    
    $post_id = $_GET['post_id'];
    
    // Видалення новини
    $result = delete_new($post_id);
    
    if (!$result) {
        throw new Exception("Помилка при видаленні новини");
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