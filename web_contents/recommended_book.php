  <h5>おすすめ本</h5>
  <div class="container">
    <!-- user_idが取得できた人のおすすめ本を表示 -->
    <? $user_id = $_GET['user_id'];
    // おすすめ本を3件表示する処理
    $sql="SELECT *
    FROM book INNER JOIN recommended_book
    ON book.book_id = recommended_book.book_id
    WHERE recommended_book.user_id = $user_id && deleteflg = 0
    ORDER BY `record_date` DESC
    LIMIT 3";?>
    <!-- 一覧を表示 -->
    <div align="right">
      <a href="recommended_more.php?user_id=<?= $_GET['user_id'];?>">一覧</a>
    </div>

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
  </div>
