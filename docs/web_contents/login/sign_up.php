<?php
  session_start();
  require "../../class/DatabaseClass.php";
  $database = new DatabaseClass();
  $pdo = $database->dbConnect();
  //エラーメッセージの初期化
  $errorMessage = "";
  if (isset($_POST["sign_up"])){
      if (!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["pass"])) {
          $email = $_POST["email"];
          $sql="select * from users where email='$email'";
          foreach ($pdo->query($sql)as $row) {
              $row["user_id"];
          }
          if (empty($row["user_id"])) {
               $_SESSION["name"] = $_POST["name"];
               $_SESSION["sex_id"] = $_POST["sex_id"];
               $_SESSION["age_id"] = $_POST["age_id"];
               $_SESSION["email"] = $_POST["email"];
               $_SESSION["pass"] = $_POST["pass"];
              header("Location: confirmation.php");
          }elseif (!empty($row["user_id"])) {
              echo $errorMessage = 'このメールアドレスは既に使用されています。';
          }
    }elseif (empty($_POST["name"])) {
        echo $errorMessage = 'ニックネームが未入力です。';
    }elseif (empty($_POST["email"])) {
        echo $errorMessage = 'メールアドレスが未入力です。';
    } else if (empty($_POST["pass"])) {
        echo $errorMessage = 'パスワードが未入力です。';
    }
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
    <title>sign_up</title>
  </head>
  <body>
    <div class="pt-5">
      <h1 class="text-center">ユーザー登録フォーム</h1>
    </div>
    <div class="container">
      <div class="pt-4">
        <form class="" action="" method="post">
        <table class="table">
          <tbody>
            <tr>
              <th class="table-info border border-dark">
                <label for="name">ニックネーム</label>
              </th>
              <td class="border border-dark">
                <div class="form-group">
                  <input type="text" style="width:200px;" class="form-control" name="name" value="" id="name" autofocus>
                </div>
              </td>
            </tr>

            <tr>
              <th class="table-info border border-dark">性別</th>
              <td class="border border-dark">

                <div class="radio">
                  <ul class="list-inline">
                    <li class="list-inline-item">
                      <input type="radio" name="sex_id" value="1" id="radio1">
                      <label for="radio1">男</label>
                    </li>

                    <li class="list-inline-item">
                      <input type="radio" name="sex_id" value="2" id="radio2">
                      <label for="radio2">女</label>
                    </li>
                  </ul>
                </div>
              </td>
            </tr>

            <tr>
              <th class="table-info border border-dark">年齢</th>
              <td class="border border-dark">
                <div class="radio">
                  <ul class="list-inline">
                    <li class="list-inline-item">
                      <input type="radio" name="age_id" value="1" id="age1">
                      <label for="age1">10代前半</label>
                    </li>
                    <li class="list-inline-item">
                      <input type="radio" name="age_id" value="2" id="age2">
                      <label for="age2">10代後半</label>
                    </li>
                    <li class="list-inline-item">
                      <input type="radio" name="age_id" value="3" id="age3">
                      <label for="age3">20代</label>
                    </li>
                    <li class="list-inline-item">
                      <input type="radio" name="age_id" value="4" id="age4">
                      <label for="age4">30代</label>
                    </li>
                    <li class="list-inline-item">
                      <input type="radio" name="age_id" value="5<" id="age5">
                      <label for="age5">40代</label>
                    </li>
                    <li class="list-inline-item">
                      <input type="radio" name="age_id" value="6" id="age6">
                      <label for="age6">50代以降</label>
                    </li>
                  </ul>
                </div>
              </td>
            </tr>

            <tr>
              <th class="table-info border border-dark">
                <label for="email">メールアドレス</label>
            </th>
            <td class="border border-dark">
              <div class="form-group">
                <input type="text" class="form-control" style="width:300px;" name="email" value="" id="email">
              </div>
            </td>
          </tr>

          <tr>
            <th class="table-info border border-dark">
              <label for="pass">パスワード</label>
            </th>
            <td class="border border-dark"><div class="form-group">
              <input type="password" class="form-control" style="width:200px;" name="pass" value="" id="pass">
            </div>
            </td>
          </tr>
        </tbody>
      </table>
      </div>
      <div class="pt-3">
        <div class="mx-auto" style="width:300px;">
            <button type="submit" name="sign_up" class="btn-lg btn-primary btn-block">送信する</button>
          </form>
        </div>
      </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
