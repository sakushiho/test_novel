<?php
  session_start();
  require "../class/DatabaseClass.php";
  $database = new DatabaseClass();
  $pdo = $database->dbConnect();
?>
<!doctype html>
<html lang=“ja”>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- top.cssの読み込み -->
    <link rel="stylesheet" href="../asset/css/top.css">
    <!-- Fonr Awesome(アイコン)の読み込み -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

    <title>トップページ</title>
  </head>
  <body>
    <!-- navbar外部ファイルの読み込み -->
    <? include('navbar.php');?>
    <br>
    <img src="../asset/image/blur-1868068_1280_s.jpg" alt="画像" height="300" class='box col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12'>
    <br>
    <br>

    <div class="container">
     <?php
     //新着本
     try {
       // 本日から二週間前
        echo date('Y-m-d',strtotime('-2 week', time()));"<br/>\n";
        $sql="SELECT * FROM `book` WHERE `release_date` >= '2018-10-27'
              ORDER BY `release_date` DESC LIMIT 3";
     } catch (\Exception $e) {

     }
     ?>
     <h5>新着本</h4>
     <div class="row">
       <?foreach ($pdo->query($sql)as $row) : ?>
         <div class='box col-12 col-xs-12 col-sm-12 col-md-6 col-lg-4'>
          <a href="book_detail.php?book_id=<?= $row['book_id'];?>"><img src="<?= $row['cover_image'];?>" alt="画像"　width="120" class="col-6"></a>
           <p class="mb-0 col-12"><a href="book_detail.php?book_id=<?= $row['book_id'];?>"><?= $row['title'];?></a></p>
           <p class="col-12"><?= $row['author'];?></p>
         </div>
       <? endforeach;?>
     </div>
     <div align="right">
       <a href="new_book_list.php">もっと見る</a>
     </div>

<?php
try {

  $sql="SELECT * , COUNT(*) AS count
        FROM recommended_book INNER JOIN book
        ON recommended_book.book_id = book.book_id
        WHERE `record_date` >= '2018-10-20 00:00:00' and `record_date` <= '2018-10-27 18:34:25'
        GROUP BY recommended_book.book_id
        ORDER BY COUNT(*) DESC
        LIMIT 3";

} catch (\Exception $e) {

}
?>
  <h5 class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">おすすめ本ウィークリーランキング</h4>
  <div class="row">
    <? foreach ($pdo->query($sql)as $row) : ?>
      <div class='box col-12 col-xs-12 col-sm-12 col-md-6 col-lg-4'>
        <a href="book_detail.php?book_id=<?= $row['book_id'];?>"><img src="<?= $row['cover_image'];?>" alt="画像"　width="120" class="col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6"></a>
        <p class="mb-0 col-12"><a href="book_detail.php?book_id=<?= $row['book_id'];?>"><?= $row['title'];?></a></p>
        <p class="mb-0 col-12"><?= $row['author'];?></p>
        <p class="col-12">おすすめ回数：<?= $row['count'];?></p>
      </div>
    <? endforeach;?>
  </div>

  <div align="right">
    <a href="weekly_ranking.php">もっと見る</a>
  </div>

 </div>
  <!-- </div> -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
