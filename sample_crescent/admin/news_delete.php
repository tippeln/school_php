<?php
require_once "util.inc.php";
require_once "db.inc.php";

define("IMAGE_PATH", "../images/press/");

require_once "auth.inc.php";
session_start();
auth_confirm();

if (isset($_GET["id"])) {
    $id = $_GET["id"];
// var_dump($id);
// $id = 5;
    $pdo = db_init();
    try {
       $stmt = $pdo->prepare("SELECT * FROM news
       WHERE id = (?)");
       $stmt->execute(array($id));
       $itemList = $stmt->fetch(PDO::FETCH_ASSOC);

       if($itemList != FALSE) {
       $posted = $itemList[posted];
       $title  = $itemList[title];
       $message= $itemList[message];
       $image  = $itemList[image];
       } else {
          $idError = "指定されたお知らせは存在しません";
       }
       // header("Location: news_add_done.php");
    }
    catch (PDOException $e) {
    echo $e->getMessage();
    exit;
    }

    if (isset($_POST["delete"])) {
        try {
           $stmt = $pdo->prepare("DELETE FROM news
           WHERE id = (?)");
           $stmt->execute(array($id));
           // $itemList = $stmt->fetchAll(PDO::FETCH_ASSOC);
           header("Location: news_delete_done.php");
           }
           catch (PDOException $e) {
           echo $e->getMessage();
           ;
          }
    }

    elseif (isset($_POST["cancel"])) {
     header("Location: index.php");
    }

 } else {
    $idError = "お知らせが指定されていません";
    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>お知らせの削除 | Crescent Shoes 管理</title>
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
    <?php if(isset($idError)): ?>
    <div class="error"><p><?php echo h($idError); ?></p></div>

  <p><a href="index.php">戻る</a></p>


<?php else: ?>
    <p>以下のお知らせを削除します。</p>
    <p>よろしければ「削除」ボタンを押してください。</p>
    <form action="" method="post">
    <table>
      <tr>
        <th class="fixed">日付</th>
        <td>
          <?php echo h($posted); ?>
        </td>
      </tr>
      <tr>
        <th class="fixed">タイトル</th>
        <td>
        <?php echo h($title); ?>
        </td>
      </tr>
      <tr>
        <th class="fixed">お知らせ内容</th>
        <td>
        <?php echo h($message); ?>
        </td>
      </tr>
      <tr>
        <th class="fixed">画像</th>

        <td>
        <?php if($image): ?>
          <img src="<?php echo IMAGE_PATH . h($image); ?>" width="64" height="64" alt="">
        <?php else: ?>
          <img src="../images/press.png" width="64" height="64" alt="">
        <?php endif; ?>
        </td>
      </tr>
    </table>
    <p>
      <input type="submit" name="delete" value="削除">
      <input type="submit" name="cancel" value="キャンセル">
    </p>
    </form>
    <?php endif; ?>
  </main>
  <footer>
    <p>&copy; Crescent Shoes All rights reserved.</p>
  </footer>
</div>
</body>
</html>
