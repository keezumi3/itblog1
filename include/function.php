<?php
    /**
     * Отримує всі пункти меню
     * @return array Масив пунктів меню
     */
    function get_menu() {
        global $conn;
        
        $sql = "SELECT * FROM menu";
        $result = mysqli_query($conn, $sql);
        
        if (!$result) {
            error_log("Помилка SQL в get_menu(): " . mysqli_error($conn));
            return [];
        }
        
        $menus = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $menus;
    }

    /**
     * Отримує всі новини, відсортовані за датою
     * @return array Масив новин
     */
    function get_news() {
        global $conn;
        $sql = "SELECT * FROM news ORDER BY datetime DESC";
        $result = mysqli_query($conn, $sql);
        
        if (!$result) {
            error_log("Помилка SQL в get_news(): " . mysqli_error($conn));
            return [];
        }
        
        $news = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $news;
    }

    /**
     * Отримує новину за ID
     * @param int $post_id ID новини
     * @return array|null Дані новини або null, якщо новина не знайдена
     */
    function get_post_by_id($post_id) {
        global $conn;
        
        // Захист від SQL-ін'єкцій
        $post_id = mysqli_real_escape_string($conn, $post_id);
        
        $sql = "SELECT * FROM news WHERE id = " . $post_id;
        $result = mysqli_query($conn, $sql);
        
        if (!$result || mysqli_num_rows($result) === 0) {
            return null;
        }
        
        $post = mysqli_fetch_assoc($result);
        return $post;
    }

    /**
     * Отримує новини за категорією
     * @param int $category_id ID категорії
     * @return array Масив новин
     */
    function get_post_by_category($category_id) {
        global $conn;
    
        $category_id = mysqli_real_escape_string($conn, $category_id);
        $sql = "SELECT * FROM news WHERE category_id = " . $category_id . " ORDER BY datetime DESC";
        $result = mysqli_query($conn, $sql);
        
        if (!$result) {
            error_log("Помилка SQL в get_post_by_category(): " . mysqli_error($conn));
            return [];
        }
        
        $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $posts;
    }

    /**
     * Отримує всі категорії
     * @return array Масив категорій
     */
    function get_categories() {
        global $conn;
        $sql = "SELECT * FROM categories ORDER BY name";
        $result = mysqli_query($conn, $sql);
        
        if (!$result) {
            error_log("Помилка SQL в get_categories(): " . mysqli_error($conn));
            return [];
        }
        
        $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $categories;
    }

    /**
     * Отримує категорію за ID
     * @param int $category_id ID категорії
     * @return array|null Дані категорії або null, якщо категорія не знайдена
     */
    function get_category_title($category_id) {
        global $conn;
        $category_id = mysqli_real_escape_string($conn, $category_id);
     
        $sql = "SELECT * FROM categories WHERE id = " . $category_id;
        $result = mysqli_query($conn, $sql);
        
        if (!$result || mysqli_num_rows($result) === 0) {
            return null;
        }
        
        $category = mysqli_fetch_assoc($result);
        return $category;
    }

    /**
     * Видаляє новину за ID
     * @param int $post_id ID новини
     * @return bool Результат операції
     */
    function delete_new($post_id) {
        global $conn;
        $post_id = mysqli_real_escape_string($conn, $post_id);

        $sql = "DELETE FROM news WHERE id = " . $post_id;
        $result = mysqli_query($conn, $sql);
        
        if (!$result) {
            error_log("Помилка SQL в delete_new(): " . mysqli_error($conn));
            return false;
        }
        
        return true;
    }
    
    /**
     * Отримує останні новини
     * @param int $limit Кількість новин
     * @return array Масив останніх новин
     */
    function get_latest_news($limit = 3) {
        global $conn;
        
        $limit = (int)$limit; // Переконуємося, що limit є цілим числом
        
        $sql = "SELECT * FROM news ORDER BY datetime DESC LIMIT " . $limit;
        $result = mysqli_query($conn, $sql);
        
        if (!$result) {
            error_log("Помилка SQL в get_latest_news(): " . mysqli_error($conn));
            return [];
        }
        
        $news = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $news;
    }
    
    /**
     * Пошук новин за ключовим словом
     * @param string $keyword Ключове слово для пошуку
     * @return array Масив знайдених новин
     */
    function search_news($keyword) {
        global $conn;
        
        $keyword = mysqli_real_escape_string($conn, $keyword);
        
        $sql = "SELECT * FROM news WHERE title LIKE '%$keyword%' OR content LIKE '%$keyword%' ORDER BY datetime DESC";
        $result = mysqli_query($conn, $sql);
        
        if (!$result) {
            error_log("Помилка SQL в search_news(): " . mysqli_error($conn));
            return [];
        }
        
        $news = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $news;
    }
?>