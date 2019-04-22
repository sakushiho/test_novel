<?php
  session_start();
  require "../class/DatabaseClass.php";
  $database = new DatabaseClass();
  $pdo = $database->dbConnect();
 include('icon_process.php'); ?>
 
<!doctype html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Fonr Awesome(アイコン)の読み込み -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

    <title>icon_upload</title>
  </head>
  <body>
    <!-- navbar外部ファイルの読み込み -->
    <?php
      include('./navbar_login.php');

      $user_id = $_SESSION['user_id'];
      //user情報取得
      $sql="select * from users where  user_id= '$user_id'";
      foreach ($pdo->query($sql)as $row) {
        $_icon = $row['icon'];
      }
    ?>
<div class="text-center">
<div class="pt-5">
    <img src="<?= $_icon ?>" class="" alt="画像"　width="100" height="100">
</div>
<div class="pt-3">
    <p>アップロードする画像を選択して下さい</p>
    <form method="post" action="" enctype="multipart/form-data">
      <input type="file" name="select_file">
      <input type="submit" name="upload" value="upload">
    </form>
</div>

<?php
  if  (isset($_POST["upload"]) && empty($path)):?>
    <p class="text-danger"> <?= "アップロード失敗　もう一度やり直してください";?></p>
<? endif;?>
<a href="my_page.php?user_id=<?= $_SESSION['user_id'];?>">マイページに戻る</a>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
