<?php
  session_start();
  require "../../class/DatabaseClass.php";
  $database = new DatabaseClass();
  $pdo = $database->dbConnect();
?>
<?php
  $errorMessage = "";

  if (!empty($_SESSION["email"]) && !empty($_SESSION['pass'])){
      // 入力したユーザIDとパスワードを格納
      $name=$_SESSION["name"];
      $sex_id = $_SESSION["sex_id"];
      $age_id = $_SESSION["age_id"];
      $email = $_SESSION["email"];
      $password = $_SESSION["pass"];
      $icon = '../asset/image/no_image.jpg';//no_imageのicon
      // 3. エラー処理
      try {
          $stmt = $pdo->prepare("INSERT INTO users(name, sex_id, age_id, email, pass,icon) VALUES (?, ?, ?, ?, ?,?)");
          $stmt->execute(array($name,$sex_id,$age_id,$email,$password,$icon,));
      } catch (PDOException $e) {
          $errorMessage = 'データベースエラー';
          // $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
          // echo $e->getMessage();
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
    <title>登録完了</title>
  </head>

  <body>
    <div class="pt-5">
      <h3 class="text-center">ご登録ありがとうございます！<br>早速ログインしてみましょう</h3>
    </div>

    <div class="pt-3">
      <div class="mx-auto" style="width:200px;">
        <form class="" action="../top.php" method="get">
          <button type="submit" class="btn btn-primary">トップページに戻る</button>
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
