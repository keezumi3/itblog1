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
    <title>Додавання нової новини</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
<div class="container mt-4">
  <div class="row mb-4">
    <div class="col">
      <h3>Додання нової новини</h3>
    </div>
    <div class="col text-right">
      <a href="index.php" class="btn btn-secondary">Назад до списку</a>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <form action="check-new.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="title">Вкажіть назву новини</label>
          <input name="title" type="text" class="form-control" id="title" required>
        </div>
        <div class="form-group">
          <label for="content">Вкажіть текст новини</label>
          <textarea name="content" class="form-control" id="content" rows="6" required></textarea>
        </div>
        <div class="form-group">
          <label for="image">Вкажіть зображення для новини</label>
          <input name="image" type="file" class="form-control-file" id="image">
        </div>
        <div class="form-group">
          <label for="category">Виберіть категорію</label>
          <select name="category_id" class="form-control" id="category">
            <?php
              $categories = get_categories();
              foreach ($categories as $category):
            ?>
              <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label for="datetime">Вкажіть дату публікації статті</label>
          <input name="datetime" type="date" class="form-control" id="datetime" value="<?= date('Y-m-d') ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Створити новину</button>
      </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>