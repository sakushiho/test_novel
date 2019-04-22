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

    <title>検索結果</title>
  </head>
  <body>
    <!-- navbar外部ファイルの読み込み -->
    <?
    if(empty($_SESSION["name"])){
      include('navbar.php');
    }elseif (!empty($_SESSION["name"])) {
      include('navbar_login.php');
    }
    ?>
   <div class="container">
     <div class="pt-2">
       <h4>検索結果</h4>
     </div>
     <div class="pt-2">
       <?
        // 検索フォームに打ち込まれた内容を変数に格納
        if (!empty($_REQUEST["search"])) :
          $result=$_REQUEST["search"];
          // 検索結果の件数を取得
          $sql = "SELECT COUNT(*) AS count FROM book where author LIKE '%$result%' or title LIKE '%$result%'";
          foreach($pdo->query($sql) as $row) {
            $count = $row['count'];
          }
        ?>
          <!-- ヒットした件数の表示 -->
          <p><? echo $count;?>件</p>
          <!-- ヒットした検索結果が0だった時の処理 -->
          <?  if ($count==0) :?>
            <p>該当する検索結果はありません</p>
          <?  endif;
          $sql = "SELECT * from book where author LIKE '%$result%' or title LIKE '%$result%'";
          foreach($pdo->query($sql) as $row) : ?>
            <!-- 画像埋め込みlink -->
            <a href="book_detail.php?book_id=<?= $row['book_id'];?>">
              <img src="<?= $row['cover_image'];?>" class="mr-3 mb-5" alt="画像" height="120" align="left">
            </a>
            <div class="pt-4">
              <!-- タイトルlink -->
              <a href="book_detail.php?book_id=<?= $row['book_id'];?>">
                <?= $row['title'];?>
              </a><br>
              <p class="pl-4"><?= $row['author'];?></p>
              <? $_SESSION['book_id']=$row['book_id'];?>
              <!-- 画像横の文字回り込み解除 -->
              <br clear="left">
            </div>
        <?
          endforeach;
        //検索フォームに何も打ち込まれていない時の処理
        else : echo  " 該当する検索結果はありません";
        endif;
        ?>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
