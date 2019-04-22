<!-- ナビゲーションバー -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
  <a class="navbar-brand" href="top.php">novel</a>

  <!-- トグルボタン -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <!-- メニュー -->
  <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <button class="btn btn-success mr-2" onclick="location.href='login/login.php'">
            ログイン</button>
      </li>
      <li class="nav-item">
        <button class="btn btn-info mr-3" onclick="location.href='login/sign_up.php'">
          新規登録</button>
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
