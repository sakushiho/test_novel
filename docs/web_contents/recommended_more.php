<?php
  session_start();
  require "../class/DatabaseClass.php";
  $database = new DatabaseClass();
  $pdo = $database->dbConnect();
 //user_idが取得できた人のマイページを表示
 $user_id = $_GET['user_id'];
 //おすすめ本を削除する処理
 if (isset($_POST['checkbox']) && is_array($_POST['checkbox']) && isset($_POST['delete'])) {
    $checkbox = $_POST["checkbox"];
    foreach($checkbox as $value){
        // echo"{$value}";
        $sql = "UPDATE recommended_book SET deleteflg = :deleteflg WHERE book_id = :book_id && user_id = $user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':deleteflg' => 1, ':book_id' => $value));
    }
    //削除したらページをリロードする処理
     header("Location:");
  }
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
    <title>recommended_book</title>
  </head>
  <body>
  <!-- 外部navの読み込み -->
  <?php include('navbar_login.php');?>
    <div class="container">
      <!-- recommended_bookの件数を数える処理 -->
      <? $sql2="SELECT COUNT(*) AS count
      FROM recommended_book
      WHERE user_id = $user_id && deleteflg = 0";
      foreach ($pdo->query($sql2)as $row):?>
        <p class="pt-3"><?= $count=$row['count'];?>件</p>
      <? endforeach;?>

      <!-- recommended_bookを表示する処理 -->
      <? $sql="SELECT *
      FROM book INNER JOIN recommended_book
      ON book.book_id = recommended_book.book_id
      WHERE recommended_book.user_id = $user_id && deleteflg = 0
      ORDER BY `record_date` DESC";?>

      <? foreach($pdo->query($sql)as $row) :?>
      <form class="" action="" method="post">
      <div class="table-responsive pt-3">
        <table class="table table-bordered" style="table-layout:fixed;">
          <tr><!-- ログインしているユーザーだったらチェックボックスを表示 -->
            <? if ($_SESSION['user_id'] == $_GET['user_id']) : ?>
            <td style="width:40px;" align="center" class="checkbox pt-5">
              <input type="checkbox" name="checkbox[]" value="<?= $row['book_id'];?>" id="<?= $row['book_id'];?>">
            </td>
            <? endif;?>
            <td style="width:80px;">
              <!-- 画像とチェックボックスを連動させている -->
              <label for="<?= $row['book_id'];?>"><img src="<?= $row['cover_image'];?>" alt="画像" width="60" name="image"></label>
            </td>
            <td>
             題名：<a href="book_detail.php?book_id=<?= $row['book_id'];?>"><?= $row['title'];?></a>
             <br>
             著者：<?= $row['author'];?>
           </td>
         </tr>
          <!-- コメントがなかったらテーブル欄は表示しない。チェックボックスを表示するので、自分のコメントテーブルの大きさは３。 他人のコメントテーブルの大きさは２。 -->
          <?echo $row['comment'] ? $_SESSION['user_id']===$_GET['user_id'] ? '<td colspan="3">' : '<td colspan="2">':'';?><?= $row['comment'];?></td>
      </table>
       <? endforeach; ?>
       
     </div>
     <!-- ログインしているユーザーは削除ボタンを表示 -->
     <?echo $_SESSION['user_id'] === $_GET['user_id'] ? '<button type="submit" name="delete" class="btn btn-primary">選択した項目を削除</button>':'';?>
    </form>

</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>
