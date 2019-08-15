<?php

require_once "util.inc.php";
require_once "db.inc.php";

// session();
session_start();
if ($_SESSION["admin_login"] != TRUE) {
    header("Location: login.php");
    exit;
}

define("IMAGE_PATH", "../images/press/");

$pdo = db_init();
$sql = "SELECT COUNT(*) AS hits FROM news";
$stmt = $pdo->query($sql);
$res = $stmt->fetch();
$hits = $res["hits"];
// ページ数の計算
$numPages = ceil($hits / 5);
 // ページ番号の取得
if (isset($_GET["p"])) {
    $page = $_GET["p"];
}
else {
    $page = 1;
}
 // LIMIT のオフセット(相殺・差し引きの意味)計算
$offset = ($page - 1) * 5;
$sql = "SELECT * FROM news order by posted desc LIMIT {$offset},5";
$stmt = $pdo->query($sql);
$itemList = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>お知らせ一覧 | Crescent Shoes 管理</title>
<link rel="stylesheet" href="css/admin.css">

<style>
.page {
  text-align: right;
}
</style>

</head>
<body id="admin_index">
<header>
  <div class="inner">
    <span><a href="index.php">Crescent Shoes 管理</a></span>
    <?php require_once "account.parts.php";  ?>
  </div>
</header>
<div id="container">
  <main>
    <h1>お知らせ一覧</h1>
    <p><a href="news_add.php">お知らせの追加</a></p>
<p class="page">
<?php if ($page == 1): ?>
    前のページ |
<?php else: ?>
    <a href="?p=<?php echo ($page - 1); ?>">前のページ</a> |
<?php endif; ?>

<?php for ($i = 1; $i <= $numPages; $i++): ?>

      <?php if($page == $i ):  ?>
          <?php echo $i; ?>|
      <?php else: ?>
          <a href="?p=<?php echo $i; ?>"><?php echo $i; ?></a>
           |
      <?php endif; ?>

<?php endfor; ?>

<?php if ($page == $numPages): ?>
      次のページ</p>
<?php else: ?>
      <a href="?p=<?php echo ($page + 1); ?>">次のページ</a></p>
<?php endif; ?>
    <table>
      <tr>
        <th>日付</th>
        <th>タイトル／お知らせ内容</th>
        <th>画像(64x64)</th>
        <th>編集</th>
        <th>削除</th>
      </tr>
      <?php foreach ($itemList as $item): ?>
          <tr>
              <td class="center"><?php echo $item["posted"]; ?></td>
              <td>
              <span class="title"><?php echo $item["title"]; ?></span>
              <?php echo $item["message"]; ?>
              </td>

              <?php if($item["image"]): ?>
                  <td class="center"><img src="<?php echo IMAGE_PATH.$item["image"]; ?>" width="64" height="64" alt=""></td>
              <?php else: ?>
                  <td class="center"><img src="<?php echo IMAGE_PATH; ?>press.png" width="64" height="64" alt=""></td>
              <?php endif; ?>

              <td class="center"><a href="news_edit.php?id=<?php echo h($item["id"]) ?>">編集</a></td>
              <td class="center"><a href="news_delete.php?id=<?php echo h($item["id"]) ?>">削除</a></td>
          </tr>
      <?php endforeach; ?>
    </table>
  </main>
  <footer>
    <p>&copy; Crescent Shoes All rights reserved.</p>
  </footer>
</div>
</body>
</html>
