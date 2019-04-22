<?php
  session_start();
  require "../../class/DatabaseClass.php";
?>



<!doctype html>
<html lang=“ja”>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>確認画面</title>
  </head>
  <body>
    <!-- 上空白 -->
    <div class="pt-5">
      <h1 class="text-center">確認画面</h1>
    </div>
    <p class="text-center">
      こちらの内容で送信します。よろしいですか？
    </p>
    <div class="mx-auto" style="width:500px;">
    <div class="container">
      <table class="table">
        <tbody>
          <tr>
            <th class="table-info border border-dark" style="width:150px;">
              <label for="name">ニックネーム</label>
            </th>
            <td class="border border-dark">
              <?php echo $_SESSION["name"];?>
            </td>
          </tr>

          <tr>
            <th class="table-info border border-dark">性別</th>
            <td class="border border-dark">
              <?php
                if ($_SESSION["sex_id"]==1) {
                  echo "男";
                }elseif ($_SESSION["sex_id"]==2) {
                  echo "女";
                }
              ?>
            </td>
          </tr>

          <tr>
            <th class="table-info border border-dark">年齢</th>
            <td class="border border-dark">
              <?php
                if ($_SESSION["age_id"]==1) {
                  echo "10代前半";
                }elseif ($_SESSION["age_id"]==2) {
                  echo "10代後半";
                }elseif ($_SESSION["age_id"]==3) {
                  echo "20代";
                }elseif ($_SESSION["age_id"]==4) {
                  echo "30代";
                }elseif ($_SESSION["age_id"]==5) {
                  echo "40代";
                }elseif ($_SESSION["age_id"]==6) {
                  echo "50代以降";
                }
              ?>
            </td>
          </tr>

          <tr>
            <th class="table-info border border-dark">
              <label for="email">メールアドレス</label>
            </th>
            <td class="border border-dark">
              <?php echo $_SESSION["email"];?>
            </td>
          </tr>

          <tr>
            <th class="table-info border border-dark">
              <label for="pass">パスワード</label>
            </th>
            <td class="border border-dark">
              <?php echo $_SESSION["pass"];?>
            </td>
          </tr>
        </tbody>
      </table>
      <div class="pt-3">
        <div class="mx-auto">
          <input type="submit" class="btn btn-outline-danger mr-1" onclick="location.href='sign_up.php'" name="" value="修正する" style="width:230px;">
          <input type="submit" class="btn btn-outline-primary" onclick="location.href='complete.php'" name="" value="送信する" style="width:230px;">
        </div>
      </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
