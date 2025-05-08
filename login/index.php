<!doctype html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Вхід в адмін-панель</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="text-center">Вхід в адмін-панель</h3>
          </div>
          <div class="card-body">
            <form class="login" action="check-login.php" method="post">
              <div class="form-group">
                <label for="exampleInputEmail1">Логін</label>
                <input type="text" name="login" class="form-control" id="exampleInputEmail1">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Пароль</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
              </div>
              <button type="submit" class="btn btn-primary btn-block">Увійти</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>