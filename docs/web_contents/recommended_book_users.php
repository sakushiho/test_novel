<?php
  session_start();
  require "../class/DatabaseClass.php";
  $database = new DatabaseClass();
  $pdo = $database->dbConnect();
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Fonr Awesome(アイコン)の読み込み -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

    <title>この本をおすすめしているユーザー</title>
  </head>
  <body>
    <!-- navbar外部ファイルの読み込み -->
    <?php

    include('./navbar.php');
    ?>
    <div class="container">

    <h4>この本をおすすめしているユーザー</h4>

    <?php
    $book_id = $_GET["book_id"];

    $sql="SELECT *
    from recommended_book INNER JOIN users
    ON recommended_book.user_id = users.user_id
    where recommended_book.book_id = $book_id
    ORDER BY `record_date` DESC";?>

    <div class="row">
      <?php
      foreach ($pdo->query($sql)as $row) : ?>
        <div class='box col-6 col-xs-4 col-sm-4 col-md-4 col-lg-4'>
          <a href="my_page.php?user_id=<?= $row['user_id'];?>"><img src="<?= $row['icon'];?>" alt="画像"　width="120" class="col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6"></a>
          <p><a href="my_page.php?user_id=<?= $row['user_id'];?>"><?= $row['name'];?></a></p>
        </div>
      <?php endforeach;?>
    </div>

    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
