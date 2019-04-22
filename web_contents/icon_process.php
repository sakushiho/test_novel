<?php
  if (isset($_POST["upload"])) {
    //一字ファイルができているか（アップロードされているか）チェック
    if(is_uploaded_file($_FILES['select_file']['tmp_name'])){
      //一字ファイルを保存ファイルにコピーできたか
      if(move_uploaded_file($_FILES['select_file']['tmp_name'],"upload/".$_FILES['select_file']['name'])){
        // データベースにiconパス格納処理
        $userid = $_SESSION['user_id'];
        $path = "upload/".$_FILES['select_file']['name'];
        if (isset($path)) {
          $sql='UPDATE users SET icon = ? WHERE user_id = ?';
          $stmt = $pdo -> prepare($sql);
          $stmt->execute(array($path,$userid));
          //格納処理後ページリロード
          header("Location: icon_upload.php");
        }
      }
    }
  }
  ?>
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>

</body>
</html>
