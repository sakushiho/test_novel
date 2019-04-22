<?php
session_start();
require "../../class/DatabaseClass.php";
$database = new DatabaseClass();
$pdo = $database->dbConnect();
//エラーメッセージの初期化
$errorMessage = "";
if (isset($_POST["login"])){
  if (!empty($_POST["email"]) && !empty($_POST["pass"])) {
    $email = $_POST["email"];
    $password = $_POST["pass"];
    $sql="select * from users where email='$email' and pass='$password'";
    foreach ($pdo->query($sql)as $row) {
      $row["name"];
      $_SESSION["name"] = $row['name'];
      $_SESSION["user_id"] = $row['user_id'];
    }
      if (isset($_SESSION["name"])) {
        header("Location: ../main.php");//session[name]が保持できたら飛ばす
        exit();
      }else if (empty($_SESSION["name"])){
        echo $errorMessage = 'メールアドレスあるいはパスワードに誤りがあります。';
      }
  }else if (empty($_POST["email"])) {
            echo $errorMessage = 'メールアドレスが未入力です。';
  }else if (empty($_POST["pass"])) {
              echo $errorMessage = 'パスワードが未入力です。';

  }
}
?>

<!doctype html>
<html lang=“ja”>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>login</title>
  </head>
  <body>
    <!-- 上空白 -->
    <div class="pt-5">
    <div class="pt-5">
    <div class="pt-5">
        <h1 class="text-center">ログイン画面</h1>
    </div>
    </div>
    </div>
    <div class="pt-4">
    <!-- フォーム要素中央寄せ -->
    <div class="mx-auto" style="width:300px;">
      <form class="" action="" method="post">
        <!-- メールアドレス -->
        <div class="form-group">
          <label for="email" class="sr-only">メールアドレス</label>
          <input type="text" class="form-control" name="email" value="" id="email" placeholder="メールアドレス" required autofocus>
        </div>
        <!-- パスワード -->
        <div class="form-group">
          <label for="pass" class="sr-only">パスワード</label>
          <input type="password" class="form-control" name="pass" value="" id="pass" placeholder="パスワード" required>
        </div>
        <div class="pt-3">
          <button type="submit" name="login" class="btn-lg btn-primary btn-block">ログイン</button>
        </div>
        </form>
      </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
