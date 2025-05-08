<?php
// Підключення до бази даних та функцій
require_once 'include/config.php';
require_once 'include/function.php';

// Отримуємо всі новини
$news = get_news();

// Підключення шапки сайту
require_once 'header.php';
?>

<div class="container mt-4">
  <div class="row">
    <div class="col-md-8">
      <h2>Останні новини</h2>
      <hr>
      
      <?php foreach ($news as $new): ?>
        <?php 
          // Отримуємо інформацію про категорію
          $category = get_category_title($new['category_id']);
        ?>
        <div class="card mb-4">
          <?php if (!empty($new['image'])): ?>
            <img src="<?= $new['image']; ?>" class="card-img-top" alt="<?= $new['title']; ?>">
          <?php endif; ?>
          <div class="card-body">
            <a href="post.php?post_id=<?=$new['id']?>">
              <h3 class="card-title"><?= $new['title'];?></h3>
            </a>
            <p class="card-text"><?= mb_substr($new['content'],0,80) . '...';?></p>
            <a href="post.php?post_id=<?=$new['id']?>" class="btn btn-primary">Читати далі</a>
            <?php if (!empty($category)): ?>
              <span class="badge bg-secondary ms-2">
                <a href="category.php?category_id=<?= $category['id'] ?>" class="text-white text-decoration-none">
                  <?= $category['name'] ?>
                </a>
              </span>
            <?php endif; ?>
          </div>
          <div class="card-footer text-muted">
            Опубліковано <?= date('d.m.Y', strtotime($new['datetime'])) ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    
    <!-- Sidebar -->
    <div class="col-md-4">
      <div class="card mb-4">
        <div class="card-header">
          <h5>Категорії</h5>
        </div>
        <div class="card-body">
          <ul class="list-group list-group-flush">
            <?php
            $categories = get_categories();
            foreach ($categories as $cat): ?>
              <li class="list-group-item">
                <a href="category.php?category_id=<?= $cat['id'] ?>">
                  <?= $cat['name'] ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
// Підключення футера
require_once 'footer.php';
?>