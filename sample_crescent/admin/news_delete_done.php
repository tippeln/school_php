<?php
require_once "util.inc.php";

session_start();
if ($_SESSION["admin_login"] != TRUE) {
    header("Location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>お知らせ削除完了 | Crescent Shoes 管理</title>
<link rel="stylesheet" href="css/admin.css">
</head>
<body>
<header>
  <div class="inner">
    <span><a href="index.php">Crescent Shoes 管理</a></span>
    <?php require_once "account.parts.php";  ?>
  </div>
</header>
<div id="container">
  <main>
    <h1>お知らせの削除</h1>
    <p>お知らせの削除が完了しました。</p>
    <p><a href="index.php">お知らせ一覧へ戻る</a></p>
  </main>
  <footer>
    <p>&copy; Crescent Shoes All rights reserved.</p>
  </footer>
</div>
</body>
</html>