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
    <!-- Fonr Awesome(アイコン)の読み込み -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <title>メインページ</title>
  </head>
  <body>
    <!-- navbar外部ファイルの読み込み -->
    <?php include('navbar_login.php');?>
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
     <h5>新着本</h5>
     <div class="row">
       <? foreach ($pdo->query($sql)as $row) : ?>
         <div class='box col-12 col-xs-6 col-sm-6 col-md-6 col-lg-4'>
           <a href="book_detail.php?book_id=<?= $row['book_id'];?>"><img src="<?= $row['cover_image'];?>" alt="画像"　width="120" class="col-6"></a>
           <p class="col-12"><a href="book_detail.php?book_id=<?= $row['book_id'];?>"><?= $row['title'];?></a></p>
           <p class="col-12"><?= $row['author'];?></p>
         </div>
      <? endforeach;?>
     </div>
     <div align="right">
       <a href="new_book_list.php">もっと見る</a>
     </div>

     <!-- おすすめ本ウィークリーランキング -->
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
     <h5>おすすめ本ウィークリーランキング</h5>
     <div class="row">
       <? foreach ($pdo->query($sql)as $row) : ?>
         <div class='box col-12 col-xs-12 col-sm-6 col-md-6 col-lg-4'>
           <a href="book_detail.php?book_id=<?= $row['book_id'];?>"><img src="<?= $row['cover_image'];?>" alt="画像"　width="120" class="col-6"></a>
           <p class="col-12"><a href="book_detail.php?book_id=<?= $row['book_id'];?>"><?= $row['title'];?></a></p>
           <p class="col-12"><?= $row['author'];?></p>
           <p class="col-12">おすすめ回数：<?= $row['count'];?></p>
         </div>
      <? endforeach;?>
     </div>

       <div align="right">
         <a href="weekly_ranking.php">もっと見る</a>
       </div>
       <!-- おすすめユーザー -->
        <?php
        $user_id=$_SESSION['user_id'];
        $sql="SELECT * FROM favorite_genre WHERE user_id=$user_id";
        foreach ($pdo->query($sql)as $row) {
              $id_list[]=$row['genre_id'];
        }
        if (isset($id_list)) :?>
          <h5>おすすめユーザー</h5>
          <div class="row">

      <?
          // IN 句に入る値を作成
          $inClause = substr(str_repeat(',?', count($id_list)), 1); // '?,?,?'
          // ログインユーザー以外で同ジャンルを登録している名前表示
          $sql="SELECT *
          FROM favorite_genre
          INNER JOIN users
          ON favorite_genre.user_id = users.user_id
          WHERE users.user_id != $user_id and favorite_genre.genre_id IN({$inClause})
          GROUP BY favorite_genre.user_id";

          $stmt = $pdo->prepare($sql);
          // プレースホルダが ? の時 execute() に配列で渡すことが出来る。
          $stmt->execute( $id_list );

          foreach ($stmt as $row) :
            ?>
              <div class="col-6 col-xs-4 col-sm-4 col-md-4 col-lg-3">
                <a href="my_page.php?user_id=<?= $row['user_id'];?>"><img src="<?= $row['icon'];?>" class="col-6"></a>
                <p class="col-12"><a href="my_page.php?user_id=<?= $row['user_id'];?>"><?= $row['name'];?></a></p>
              </div>
      <?  endforeach;
        endif;?>
          </div>
       </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
