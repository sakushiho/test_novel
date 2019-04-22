<?
session_start();
require "../class/DatabaseClass.php";
$database = new DatabaseClass();
$pdo = $database->dbConnect();

//ログインしているか確認
if (!isset($_SESSION["user_id"])){
  echo '非ログイン';
}
// recommended.jsから受け取った情報
$book_id=$_POST['book_id'];
$recommended_deleteflg=$_POST['recommended_deleteflg'];
$comment = $_POST["comment"];

if (isset($_SESSION["user_id"])) {
  $user_id = $_SESSION["user_id"];

  // おすすめ本を論理削除
  if ($recommended_deleteflg==0)  {
        $sql = "UPDATE recommended_book
        SET deleteflg = :deleteflg WHERE book_id = $book_id && user_id = $user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':deleteflg' => 1));
        echo '1';
  // 削除フラグが立った本を改めておすすめ。コメントがあれば格納。登録しなおしたrecord_dateを取得
  }else if ($recommended_deleteflg==1) {
      $sql = "UPDATE recommended_book
      SET deleteflg = :deleteflg,
          comment = :comment,
          record_date = CURRENT_TIMESTAMP
      WHERE book_id = $book_id && user_id = $user_id";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(array(':deleteflg' => 0,':comment' => $comment));
      echo '0';
  // 初めておすすめ。コメントがあれば格納
  }elseif ($recommended_deleteflg==3){
      $stmt = $pdo->prepare("INSERT INTO recommended_book(user_id, book_id,comment) VALUES (?, ?, ?)");
      $stmt->execute(array($user_id,$book_id, $comment));
      echo '0';
  }
}
?>
