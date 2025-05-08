<?php
// Підключення до бази даних
require_once 'include/config.php';

// Підключення функцій
require_once 'include/function.php';

// Функція для отримання новини за ID
function get_news_by_id($id) {
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);
    $sql = "SELECT * FROM news WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    
    return mysqli_fetch_assoc($result);
}

// Отримуємо ID новини з URL
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$news_item = get_news_by_id($id);

// Якщо новина не знайдена, перенаправляємо на головну сторінку
if (!$news_item) {
    header("Location: index.php");
    exit;
}

// Підключення шапки сайту
require_once 'header.php';
?>

<div class="container mt-4">
  <div class="row">
    <div class="col-md-8">
      <div class="card mb-4">
        <img src="<?= $news_item['image']; ?>" class="card-img-top" alt="...">
        <div class="card-body">
          <h2 class="card-title"><?= $news_item['title']; ?></h2>
          <p class="text-muted"><?= date('d.m.Y H:i', strtotime($news_item['datetime'])); ?></p>
          <div class="card-text">
            <?= nl2br($news_item['content']); ?>
          </div>
          <a href="index.php" class="btn btn-primary mt-3">Назад до списку новин</a>
        </div>
      </div>
    </div>
    
    <!-- Бічна панель (sidebar) -->
    <div class="col-md-4">
      <div class="card mb-4">
        <div class="card-header">
          <h5>Категорії</h5>
        </div>
        <div class="card-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Програмування</li>
            <li class="list-group-item">Веб-дизайн</li>
            <li class="list-group-item">Веб-розробка</li>
            <li class="list-group-item">Мережі</li>
          </ul>
        </div>
      </div>
      
      <div class="card">
        <div class="card-header">
          <h5>Інші новини</h5>
        </div>
        <div class="card-body">
          <?php 
          $other_news = get_news();
          $count = 0;
          ?>
          <ul class="list-group list-group-flush">
            <?php foreach ($other_news as $item): ?>
              <?php if ($item['id'] != $id && $count < 3): ?>
                <li class="list-group-item">
                  <a href="news-detail.php?id=<?= $item['id']; ?>"><?= $item['title']; ?></a>
                </li>
                <?php $count++; ?>
              <?php endif; ?>
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