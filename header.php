<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Blog</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        .navbar {
            background-color: #343a40 !important;
            padding: 0.5rem 1rem;
        }
        .navbar-brand {
            color: #fff !important;
            font-weight: bold;
            font-size: 1.5rem;
            margin-right: 2rem;
        }
        .navbar-nav .nav-link {
            color: #adb5bd !important;
            padding: 0.5rem 1rem;
            transition: color 0.3s;
        }
        .navbar-nav .nav-link:hover, 
        .navbar-nav .nav-link.active {
            color: #fff !important;
        }
        .search-form {
            display: flex;
        }
        .search-form .form-control {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
        .search-form .btn {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            background-color: #28a745;
            border-color: #28a745;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">IT Blog</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php
        $categories = get_categories();
        foreach ($categories as $category):
        ?>
        <li class="nav-item">
          <a class="nav-link" href="category.php?category_id=<?=$category['id'];?>">
            <?=$category["name"]?>
          </a>
        </li>
        <?php endforeach; ?>
      </ul>
      
      <div class="d-flex">
        <a href="login/index.php" class="btn btn-outline-light me-2">Вхід</a>
      </div>
      
      <form class="search-form d-flex ms-2" role="search">
        <input class="form-control me-0" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<!-- Тут буде основний вміст сторінки -->