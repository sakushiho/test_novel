<?php
  $pdo = $database->dbConnect();
  //ユーザーコメントアップデート処理
  $user_id = $_SESSION['user_id'];

  if (isset($_POST['editing'])) {
    //リネーム処理
    if (isset($_POST['rename'])){
      $rename = $_POST['rename'];
      $sql='UPDATE users SET name = ? WHERE user_id = ?';
      $stmt = $pdo -> prepare($sql);
      $stmt->execute(array($rename,$user_id));
    }
    //ジャンル登録処理
    if (isset($_POST["genre_id"])) {
      // チェックボックスで選択された項目を変数に格納
      $checkbox=$_POST["genre_id"];
        //既に登録しているジャンルがある場合も考えアップデートを含んだ処理
        foreach($checkbox as $value){
          $stmt = $pdo->prepare("INSERT INTO favorite_genre (genre_id, user_id) VALUES (?, ?)
                                  ON DUPLICATE KEY UPDATE genre_id = values(genre_id);");
          $stmt->execute(array($value,$user_id));
        }
    }
      // コメント処理
    if (empty($_POST['user_comment'])) {
      $user_comment = $_POST['user_comment'];
      $sql='UPDATE users SET user_comment = ? WHERE user_id = ?';
      $stmt = $pdo -> prepare($sql);
      $stmt->execute(array($user_comment,$user_id));
    }
    // 処理が終わったらreload
    header("Location:");
  }

  // renameのformに表示するユーザーの今のニックネームの取得
  $sql="select * from users where  user_id= $user_id";
  foreach ($pdo->query($sql)as $row) {
    $user_name = $row['name'];
  }
  ?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <title>comment</title>
  </head>
    <body>
<!-- モーダルの記述 -->

          <!-- モーダルの設定 -->
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">

                  <!-- モーダルのタイトル -->
                  <h5 class="modal-title" id="exampleModalLabel">編集画面</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <!-- モーダルのコンテンツ文。 -->
                <div class="modal-body">
                  <form class="" action="" method="post">
                    <!-- リネームのフォーム -->
                    <div class="form-group">
                      <label for="rename">ニックネーム</label>
                      <input type="text" class="form-control" name="rename" value="<?=$user_name?>" id="rename">
                    </div>
                    <!-- ジャンル登録テーブル -->
                    <table class="table">
                      <tbody>
                        <tr>
                          <td class="border border-dark">
                            <ul>
                              <? $sql="SELECT * FROM genre";
                                 foreach ($pdo->query($sql)as $row) :?>
                               <li class="list-inline-item">
                               <input type="checkbox" name="genre_id[]" value="<?= $row['genre_id'];?>" id="<?= $row['genre_id'];?>">
                               <label for="<?= $row['genre_id'];?>"><?= $row['genre_name'];?></label>
                               </li>
                             <?   endforeach;?>
                             </ul>
                           </td>
                         </tr>
                      </tbody>
                    </table>
                    <!-- ユーザーコメントのフォーム -->
                    <textarea name="user_comment" class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12" cols="50" placeholder="50字以内でコメントを書いてください"></textarea>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                  <button type="submit" class="btn btn-primary" name="editing">変更を保存</button>
                </form>
                </div><!-- /.modal-footer -->
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
  </body>
</html>
