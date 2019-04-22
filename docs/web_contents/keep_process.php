<?php
session_start();
require "../class/DatabaseClass.php";
$database = new DatabaseClass();
$pdo = $database->dbConnect();
//ログインしているか確認
if (!isset($_SESSION["user_id"])){
  echo '非ログイン';
}
// keep.jsから受け取ったbook_id
$book_id=$_POST['book_id'];
$keep_deleteflg=$_POST['keep_deleteflg'];

if (isset($_SESSION["user_id"])) {
  $user_id = $_SESSION["user_id"];

  // キープを論理削除
  if ($keep_deleteflg==0)  {
        $sql = "UPDATE keep_book SET deleteflg = :deleteflg WHERE book_id = :book_id && user_id = $user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':deleteflg' => 1, ':book_id' => $book_id));
        echo '1';
  // 削除フラグが立った本を改めてキープ
  }else if ($keep_deleteflg==1) {
      $sql = "UPDATE keep_book SET deleteflg = :deleteflg WHERE book_id = :book_id && user_id = $user_id";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(array(':deleteflg' => 0, ':book_id' => $book_id));
      echo '0';
  // 初めてキープ
  }elseif ($keep_deleteflg==3){
      $stmt = $pdo->prepare("INSERT INTO keep_book(user_id, book_id) VALUES (?, ?)");
      $stmt->execute(array($user_id,$book_id));
      echo '0';
  }
}

?>
