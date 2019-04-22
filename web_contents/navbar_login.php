<!-- ここから外部ファイル化する -->
<!-- ナビゲーションバー -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
  <a class="navbar-brand" href="main.php">novel</a>

  <!-- トグルボタン -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <!-- メニュー -->
  <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
    <ul class="navbar-nav">

      <li class="nav-item">
        <!-- ログイン時に保持したsession[user_id]をurlに組み込む-->
        <a class="nav-link"
          href="my_page.php?user_id=<?= $_SESSION['user_id'];?>">
        <!-- ログインしているユーザーの名前のリンク-->
        <?
          $login_userid = $_SESSION['user_id'];
          $sql="select * from users where user_id = $login_userid";
          foreach ($pdo->query($sql)as $row) {
            $login_username = $row['name'];
          }
          echo htmlspecialchars($login_username, ENT_QUOTES);
        ?>
          さん
        </a>
      </li>


      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle mr-2" href="friend.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          友だち
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="follow.php">フォロー</a>
          <a class="dropdown-item" href="follower.php">フォロワー</a>
        </div>
      </li>

      <!-- モーダルボタン -->
      <li class="nav-item">
        <button class="btn btn-outline-info mr-3" data-toggle="modal" data-target="#modal-sample">
          ログアウト</button>
        </li>
      </ul>

      <!-- 検索フォーム -->
    <div class="collapse" id="collapseExample">
      <form class="form-inline" action="search_results.php"　method="GET">
        <input class="form-control mr-sm-2" type="search" name="search" aria-label="Search">
      </form>
    </div>
      <!-- searchボタン -->
      <button type="button" class="btn btn-outline-success my-2 my-sm-0" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        <i class="fas fa-search"></i>
      </button>



</div>
</nav>

<!-- 1.モーダルを表示する為のボタン -->
<!-- <button class="btn btn-primary">
モーダルを表示
</button> -->

<!-- 2.モーダルの配置 -->
<div class="modal" id="modal-sample" tabindex="-1">
<div class="modal-dialog">


    <!-- 3.モーダルのコンテンツ -->
    <div class="modal-content">
        <!-- 4.モーダルのヘッダ -->
        <div class="modal-header">
          <h4 class="modal-title" id="modal-label">ログアウト</h4>
          <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- 5.モーダルのボディ -->
        <div class="modal-body">
            本当にログアウトしますか？
        </div>
        <!-- 6.モーダルのフッタ -->
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
            <button type="button" onclick="location.href='login/logout.php'"class="btn btn-primary">ログアウト</button>
        </div>
    </div>
</div>
</div>
