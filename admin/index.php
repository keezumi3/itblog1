<?php
    session_start();
    $login = 'admin';
    $pass = '123';

    if ($_SESSION["login"] !== $login || $_SESSION["password"] !== $pass){
        header('location: ../login/index.php');
        exit;
    }

    include_once '../include/config.php';
    include_once '../include/function.php';
?>

<!doctype html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Адмін-панель</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-10">
            <h2>Адміністративна панель</h2>
        </div>
        <div class="col-2 text-right">
            <a href="logout.php" class="btn btn-primary">Вихід</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Назва новини</th>
                    <th scope="col">Категорія</th>
                    <th scope="col">Дата</th>
                    <th scope="col">Редагувати</th>
                    <th scope="col">Видалити</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $posts = get_news();
                    foreach ($posts as $post):
                        $category = get_category_title($post['category_id']);
                        $category_name = $category ? $category['name'] : 'Без категорії';
                ?>
                <tr>
                    <th scope="row"><?=$post['id']?></th>
                    <td><?=$post['title']?></td>
                    <td><?=$category_name?></td>
                    <td><?=date('d.m.Y', strtotime($post['datetime']))?></td>
                    <td><a href="edit-new.php?post_id=<?=$post['id']?>" class="btn btn-info">Редагувати</a></td>
                    <td><a href="delete-new.php?post_id=<?=$post['id'];?>" class="btn btn-danger" onclick="return confirm('Ви впевнені, що хочете видалити цю новину?')">Видалити</a></td>
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>
            <a href="add-new.php" class="btn btn-success">Додати новину</a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>