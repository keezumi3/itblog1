<?php
  // Підключення до бази даних та функцій
  require_once 'include/config.php';
  require_once 'include/function.php';
  
  // Підключення шапки сайту
  include_once "header.php";
  
  // Отримання id новини з GET-параметра
  $post_id = $_GET['post_id'];
  
  // Валідація id (перевірка, що це число)
  if (!is_numeric($post_id)) exit();
  
  // Отримання новини за id
  $post = get_post_by_id($post_id);
  
  // Отримання інформації про категорію
  $category = get_category_title($post['category_id']);
?>

<div class="container mt-4">
  <div class="row">
    <div class="col">
      <div class="card">
        <?php if (!empty($post['image'])): ?>
          <img src="<?=$post['image']?>" class="card-img-top" alt="<?=$post['title']?>">
        <?php endif; ?>
        <div class="card-body">
          <h5 class="card-title"><?=$post['title']?></h5>
          <?php if (!empty($category)): ?>
            <div class="mb-2">
              <span class="badge bg-secondary">
                <a href="category.php?category_id=<?= $category['id'] ?>" class="text-white text-decoration-none">
                  <?= $category['name'] ?>
                </a>
              </span>
            </div>
          <?php endif; ?>
          <p class="text-muted">Опубліковано: <?= date('d.m.Y H:i', strtotime($post['datetime'])) ?></p>
          <p class="card-text"><?=$post['content']?></p>
          <a href="index.php" class="btn btn-primary">Назад</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
  // Підключення футера
  include_once "footer.php";
?>