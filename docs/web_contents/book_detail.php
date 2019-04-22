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
    <title>本の詳細</title>
  </head>
  <body>
    <!-- navbar外部ファイルの読み込み -->
    <?php isset($_SESSION["user_id"]) ? include('navbar_login.php') : include('navbar.php'); ?>

    <div class="container">
      <h1>本の詳細</h1>

    <?php
    $book_id = $_GET["book_id"];
    $keep_deleteflg = 3;
    $recommended_deleteflg = 3;
    // キープとおすすめの削除フラグの確認と変数に代入
    if (isset($_SESSION["user_id"])) {
      $user_id = $_SESSION["user_id"];
      $sql="select * from keep_book where user_id = $user_id and book_id = $book_id";//既にキープ本に登録しているかkeep_bookを調べる
      foreach ($pdo->query($sql)as $row) {
        $keep_deleteflg = $row['deleteflg'];
      }
      $sql="select * from recommended_book where user_id = $user_id and book_id = $book_id";//既にキープ本に登録しているかkeep_bookを調べる
      foreach ($pdo->query($sql)as $row) {
        $recommended_deleteflg = $row['deleteflg'];
      }
    }
    ?>
  <div class="row">
    <?php
      $sql="select * from book where book_id = $book_id";
     foreach ($pdo->query($sql)as $row) : ?>
      <div class='box col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12'>
      <img src="<?= $row['cover_image'];?>" alt="画像"　width="120" class="col-3 col-xs-3 col-sm-3 col-md-3 col-lg-3">
      <p class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">題名:　<?= $row['title'];?></p>
      <p class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">著者:　<?= $row['author'];?></p>
      <p class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">書籍番号:　<?= $row['book_id'];?></p>
      <p class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">発売日:　<?= $row['release_date'];?></p>
      <p class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">あらすじ:　<br><?= $row['summary'];?></p>
      </div>
  <?php endforeach; ?>
  </div>
  <!-- キープボタン -->
  <button type="button" name="keep" id="keep" class="btn btn-success mt-2 mb-3" value="<?= $keep_deleteflg;?>">
    <?echo $keep_deleteflg==0 ? 'キープ中' : 'キープする';?>
  </button> <br>

  <label for="comment" class="control-label">コメントを書いておすすめしよう！</label>
  <textarea name="comment" class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12" id="comment" cols="50" placeholder="コメントを書いてください"></textarea>
  <!-- 注意書きは以下 -->
  <p class="help-block">※100文字以内で書いてください</p>
  <input type="hidden" name="book_id" value="<?= $book_id?>" />

  <button type="button" id="recommended" name="recommended" class="btn btn-primary mb-4" value="<?=$recommended_deleteflg;?>">
    <?echo $recommended_deleteflg==0 ? '登録中' : 'おすすめする';?>
  </button> <br>

      <?php
      //おすすめしているユーザーの表示
        $sql="SELECT *
        from recommended_book INNER JOIN users
        ON recommended_book.user_id = users.user_id
        where recommended_book.book_id = $book_id && deleteflg = 0
        ORDER BY `record_date` DESC";
        //ログインしているユーザーのみ表示
        if (isset($_SESSION["name"])):
        //この本をおすすめしているユーザーという文字を出力する処理。おすすめしているユーザーがいない場合は文字も表示しない
           foreach ($pdo->query($sql)as $row) {
              $recommended_book = $row['book_id'];
            }
            if (isset($recommended_book)) {
              print '<h4>この本をおすすめしているユーザー</h4>';
            }
?>
              <div class="row">
<?php           $i = 0;
              foreach ($pdo->query($sql)as $row) :
                if ($i >= 3) {
                  break;
                } ?>
                <div class='box col-6 col-xs-4 col-sm-4 col-md-4 col-lg-4'>
                  <a href="my_page.php?user_id=<?= $row['user_id'];?>"><img src="<?= $row['icon'];?>" alt="画像"　width="120" class="col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6"></a>
                  <p><a href="my_page.php?user_id=<?= $row['user_id'];?>"><?= $row['name'];?></a></p>
                </div>
<?php           $i++;
              endforeach;?>
            </div>
            <? if ($i >= 3) :?>
              <div align="right">
                <a href="recommended_book_users.php?book_id=<?= $book_id?>">もっと見る</a>
              </div>
          <? endif;
             endif; ?>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script src="../asset/js/recommended.js"></script>
    <script src="../asset/js/keep.js"></script>
  </body>
</html>
