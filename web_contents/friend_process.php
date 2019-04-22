<?php
session_start();
require "../class/DatabaseClass.php";
$database = new DatabaseClass();
$pdo = $database->dbConnect();
$login_id = $_SESSION["user_id"];//ログインしているユーザー
$page_userid = $_SESSION['page_userid'];//マイページのユーザー

  if ($_POST["follow"]==0) {
    try {
        $stmt = $pdo->prepare("INSERT INTO friend(user_id, follow_id) VALUES (?, ?)");
        $stmt->execute(array($login_id,$page_userid));
        // echo 'フォローしました！';
        echo '1';

      } catch (PDOException $e) {
        $errorMessage = 'データベースエラー1';
        echo $errorMessage;
        // $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
        // echo $e->getMessage();
      }
  //フォロー解除の処理データベースからもフレンドを削除
  }else {
    try {
        $sql = 'DELETE FROM friend WHERE user_id = ? and follow_id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($login_id,$page_userid));
        // echo 'フォロー解除しました！';
        echo '0';
      } catch (PDOException $e) {
        $errorMessage = 'データベースエラー2';
        echo $errorMessage;
        // $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
        // echo $e->getMessage();
      }
  }
?>
