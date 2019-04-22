<?php
  session_start();
  require "../class/DatabaseClass.php";
  $database = new DatabaseClass();
  $pdo = $database->dbConnect();
  //ユーザーコメント登録機能を読み込む
  include('edit_process.php');
?>

<!doctype html>
<html lang=“ja”>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- cssの読み込み -->
    <link rel="stylesheet" href="../asset/css/my_page.css">

    <!-- Fonr Awesome(アイコン)の読み込み -->
    <!-- <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script> -->
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <title>マイページ</title>
  </head>
  <body>
    <!-- navbar外部ファイルの読み込み -->
    <?php
      include('./navbar_login.php');

      $login_userid = $_SESSION["user_id"];//ログインユーザー
      $page_userid = $_GET["user_id"];//マイページユーザー
      $_SESSION['page_userid'] = $page_userid;//pageのidをSESSIONに代入
      $followFlg = 0 ;
        if (isset($login_userid)) {
        //フォロー済みの場合flgに1を入れることでボタンの要素を変える
        $sql="select * from friend where user_id = $login_userid and follow_id = $page_userid";
        foreach ($pdo->query($sql)as $row) {
          $followFlg = 1 ;
          }
        }
      //favorite_genreテーブルとgenreテーブル結合
      $sql="SELECT *
        FROM favorite_genre INNER JOIN genre
        ON favorite_genre.genre_id = genre.genre_id
        WHERE favorite_genre.user_id = $page_userid";
      //ユーザーの好きなジャンルを変数に格納
      foreach ($pdo->query($sql)as $row) {
        // 複数好きなジャンルがある場合は配列として保持
        $favorite_genre[] = $row['genre_name'];
      }
      //マイページのユーザー情報の表示
      $sql="select * from users where user_id = $page_userid";
      foreach ($pdo->query($sql)as $row) :
    ?>
    <div class="container">
      <? if ($login_userid == $page_userid): ?>
        <div class="pt-3">
          <!-- モーダルを出現させるボタン -->
          <div class="float-right">
            <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#myModal">
              プロフィールを編集
            </button>
          </div>
        </div>
      <? endif; ?>
      <div class="pt-5">
        <!-- ユーザーアイコン -->
        <div class="icon">
          <img src="<?= $row['icon'];?>" class="" alt="画像"　width="100" height="100">
          <!-- 画像編集ボタンの表示非表示 -->
          <? if ($login_userid == $page_userid): ?>
            <div class="mb-4">
              <div class="upload_relative">
                <a href="icon_upload.php">
                  <button class="btn btn-primary rounded-circle p-0" style="width:2rem;height:2rem;" type="submit">
                    <i class="fas fa-camera"></i>
                  </button>
                </a>
              </div>
            </div>
          <? endif; ?>
          </div>
        </div>

        <div class="text-center">
          <div class="pt-2">
            <!-- ユーザーニックネーム -->
            <h4 class="mb-0 mt-1"><?= $row['name']; ?></h4>
            <!-- ユーザーid -->
            <p class="text-secondary mb-1">ID: <?= $row['user_id']; ?></p>

            <!-- ユーザーの好きなジャンル -->
            <?if (isset($favorite_genre)) :?>
            <div class="pb-2">
              <span class="text-secondary">好きなジャンル:
                <?
                //配列の値の数だけジャンルを表示
                for ( $i = 0; $i < count( $favorite_genre ); ++ $i ) {
                  // $配列の名前[$i]を使用した処理
                    echo $favorite_genre[$i];
                    echo "、";
                }
                ?>
              </span>
            </div>
            <?endif;?>
             <!-- ユーザーコメント -->
            <p class="text-secondary"><?= $row['user_comment'];?></p>
          </div>

        <!-- フォローボタン表示非表示 -->
        <? if ($login_userid != $page_userid) :?>
            <button name="follow" class="btn btn-primary mb-1 follow_button" value="<?= $followFlg;?>">
              <?echo $followFlg==0 ? 'フォローする' : 'フォロー中';?>
            </button>
          <br>

        <? endif;
        endforeach; ?>

        <!-- おすすめ本リンク -->
        <div class="pb-1">
          <br>
        </div>
    </div>
    <?include('recommended_book.php');?>
    <!-- キープ本表示非表示 -->
    <? if ($login_userid == $page_userid) :?>
      <?include('keep_book.php');?>
    <? endif;?>
  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script src="../asset/js/friend.js"></script>

  </body>
</html>
