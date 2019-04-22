  <h5>キープ本</h5>
  <!-- 一覧を表示 -->
  <div align="right">
    <a href="keep_more.php?user_id=<?= $user_id;?>">一覧</a>
  </div>

  <!-- ログインしているユーザー -->
  <? $user_id = $_SESSION['user_id'];
  //キープ本を3件表示する処理
  $sql="SELECT *
  FROM keep_book INNER JOIN book
  ON keep_book.book_id = book.book_id
  WHERE keep_book.user_id = $user_id && deleteflg = 0
  LIMIT 3";?>

  <div class="table-responsive">
    <table class="table table-bordered" style="table-layout:fixed;">
      <tbody>
        <? foreach ($pdo->query($sql)as $row) : ?>
        <tr>
          <td style="width:80px;">
            <a href="book_detail.php?book_id=<?= $row['book_id'];?>"><img src="<?= $row['cover_image'];?>" alt="画像" width="60"></a>
          </td>
          <td>題名：<a href="book_detail.php?book_id=<?= $row['book_id'];?>"><?= $row['title'];?></a></td>
          <td>著者：<?= $row['author'];?></td>
        </tr>
        <?php endforeach;?>
    </tbody>
  </table>
</div>
