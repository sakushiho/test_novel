<?php
  session_start();
  require "../class/DatabaseClass.php";
  $database = new DatabaseClass();
  $pdo = $database->dbConnect();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Fonr Awesome(アイコン)の読み込み -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

    <title>新着本</title>
  </head>
  <body>
      <!-- navbar外部ファイルの読み込み -->
      <?php
      if(empty($_SESSION["name"])){
        include('./navbar.php');
      }elseif (!empty($_SESSION["name"])) {
        include('./navbar_login.php');
      }
      ?>
      <div class="container">
      <?php
        try {
          // 本日から二週間前
           echo date('Y-m-d',strtotime('-2 week', time()));"<br/>\n";
           $sql="SELECT * FROM `book` WHERE `release_date` >= '2018-10-27'
                 ORDER BY `release_date` DESC";

        } catch (\Exception $e) {

        }
      ?>
        <h5>新着本</h4>
        <div class="row">
          <? foreach ($pdo->query($sql)as $row) : ?>
          <div class='box col-12 col-xs-12 col-sm-12 col-md-6 col-lg-4'>
            <a href="book_detail.php?book_id=<?= $row['book_id'];?>"><img src="<?= $row['cover_image'];?>" alt="画像"　width="120" class="col-6"></a>
            <p class="mb-0 col-12"><a href="book_detail.php?book_id=<?= $row['book_id'];?>"><?= $row['title'];?></a></p>
            <p class="col-12"><?= $row['author'];?></p>
          </div>
          <? endforeach; ?>
        </div>

    </div>
  </body>
</html>
