<?php
  require_once 'include/config.php';
  require_once 'include/function.php';
  require_once 'header.php';
?>

<div class="container mt-4">
  <div class="row">
    <div class="col-md-8">
      <?php
        $category_id = $_GET['category_id'];
        $posts = get_post_by_category($category_id);
        $category = get_category_title($category_id);
      ?>
      <h2><?= $category['name'] ?></h2>
      <hr>
      
      <?php if (empty($posts)): ?>
        <div class="alert alert-info">
          У цій категорії поки немає новин.
        </div>
      <?php else: ?>
        <?php foreach ($posts as $post): ?>
          <div class="card mb-4">
            <?php if (!empty($post['image'])): ?>
              <img class="card-img-top img-fluid" src="<?= $post['image'] ?>" alt="<?= $post['title'] ?>">
            <?php endif; ?>
            <div class="card-body">
               <a href="post.php?post_id=<?=$post['id']?>">
                 <h3 class="card-title"><?=$post['title'];?></h3>
               </a>
               <p class="card-text"><?=mb_substr($post['content'],0,400) . '...'?></p>
               <a href="post.php?post_id=<?=$post['id']?>" class="btn btn-primary">Детальніше &rarr;</a>
            </div>
            <div class="card-footer text-muted">
              Опубліковано <?= date('d.m.Y', strtotime($post['datetime'])) ?> 
              <a href="#">Admin</a>
            </div>
          </div>
        <?php endforeach;?>
      <?php endif; ?>
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
              <li class="list-group-item <?= ($cat['id'] == $category_id) ? 'active' : '' ?>">
                <a href="category.php?category_id=<?= $cat['id'] ?>" class="<?= ($cat['id'] == $category_id) ? 'text-white' : '' ?>">
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
  require_once 'footer.php';
?>