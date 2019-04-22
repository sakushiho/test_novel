<?php
  session_start();
  require "../class/DatabaseClass.php";
  $database = new DatabaseClass();
  $pdo = $database->dbConnect();
  // ログインしているユーザー
  $user_id=$_SESSION['user_id'];
  //キープ本を削除する処理
  if (isset($_POST['checkbox']) && is_array($_POST['checkbox']) && isset($_POST['delete'])) {
      $checkbox = $_POST["checkbox"];
      foreach($checkbox as $value){
          // echo"{$value}";
          $sql = "UPDATE keep_book SET deleteflg = :deleteflg WHERE book_id = :book_id && user_id = $user_id";
          $stmt = $pdo->prepare($sql);
          $stmt->execute(array(':deleteflg' => 1, ':book_id' => $value));
          echo '削除しました';
          echo "<br/>";
      }
      //削除したらページをリロードする処理
       header("Location:");
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
    <!-- Fonr Awesome(アイコン)の読み込み -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <title>キープ本</title>
  </head>
  <body>
    <!-- navbar外部ファイルの読み込み -->
    <?php include('./navbar_login.php');?>
    <div class="container">
      <h2>キープ本</h2>
      <!-- keep_bookの件数を数える処理 -->
      <? $sql2="SELECT COUNT(*) AS count
      FROM keep_book
      WHERE user_id = $user_id && deleteflg = 0";
      foreach ($pdo->query($sql2)as $row):?>
        <p class="pt-3"><?= $count=$row['count'];?>件</p>
      <? endforeach;?>
      <!-- keep_bookを表示する処理 -->
      <? $sql="SELECT *
          FROM keep_book INNER JOIN book
          ON keep_book.book_id = book.book_id
          WHERE keep_book.user_id = $user_id && deleteflg = 0";?>

          <form class="" action="" method="post">
          <div class="table-responsive">
            <table class="table table-bordered" style="table-layout:fixed;">
              <tbody>
                <? foreach ($pdo->query($sql)as $row) :?>
                <tr>
                  <td class="checkbox" style="width:50px;">
                    <input type="checkbox" name="checkbox[]" value="<?= $row['book_id'];?>">
                  </td>
                  <td style="width:80px;">
                    <a href="book_detail.php?book_id=<?= $row['book_id'];?>"><img src="<?= $row['cover_image'];?>" alt="画像" width="60"></a>
                  </td>
                  <td>題名：<a href="book_detail.php?book_id=<?= $row['book_id'];?>"><?= $row['title'];?></a></td>
                  <td>著者：<?= $row['author'];?></td>
                </tr>
                <? endforeach;?>
              </tbody>
            </table>
          </div>

          <button type="submit" name="delete" class="btn btn-primary"> 選択した項目を削除</button>
        </form>

    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
