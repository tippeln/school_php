<?php
require_once "util.inc.php";
require_once "db.inc.php";
date_default_timezone_set('Asia/Tokyo');
define("IMAGE_PATH", "../images/press/");

require_once "auth.inc.php";
session_start();
auth_confirm();

$posted  = date("Y-m-d");//現在日時を設定 dateは日付を取得する標準関数
$title  = "";
$message = "";
// 初期表示のエラー表示を防ぐために空値を設定
$image  = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  if (isset($_POST["add"])) {
   // バリデーションフラグ
   $isValidated = TRUE;
   // 入力値の取得
   $date = $_POST["posted"];
   $title = $_POST["title"];
   $message = $_POST["message"];

if ($posted === "" || mb_ereg_match("^(\s|　)+$", $posted)) {
   $date = date("Y-m-d");
   }
   elseif (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $date)) {
   $titleError = "日付は「0000-00-00」の形式で入力してください";
   var_dump($date);
   $isValidated = FALSE;
   }
   // タイトルのバリデーション
   if ($title === "") {
   $titleError = "※タイトルを入力してください";
   $isValidated = FALSE;
   }
   // お知らせのバリデーション
   if ($message === "") {
   $messageError = "※お知らせ内容を入力して下さい";
   $isValidated = FALSE;
   }
   //画像アップロードのバリデーション
   if ($_FILES["image"]["error"] == UPLOAD_ERR_OK) {
   $name = $_FILES["image"]["name"];
   $name = mb_convert_encoding($name, "cp932", "utf8");
   $temp = $_FILES["image"]["tmp_name"];
   var_dump($name);
    if (move_uploaded_file($temp, "../images/press/" . $name)) {
      // $imegeError = "アップロードされたファイルはありません。";
      }
    } elseif($_FILES["userfile"]["error"] == UPLOAD_ERR_NO_FILE) {
     // 何もしない
   } else {
      $imageError = "※アップロードに失敗しました";
   }
  }
  elseif (isset($_POST["cancel"])) {
    header("Location: index.php");
  }
}
if($isValidated) {
   var_dump($name);


try {
   $pdo = db_init();
   if($name == "") {
   $stmt = $pdo->prepare("INSERT INTO news
   (posted, title, message)VALUES
   (?, ?, ?)");
   $stmt->execute(array($date, $title, $message));
   header("Location: news_add_done.php");
   }
   else {
   $stmt = $pdo->prepare("INSERT INTO news
   (posted, title, message, image)VALUES
   (?, ?, ?, ?)");
   $stmt->execute(array($date, $title, $message, $name));
   header("Location: news_add_done.php");
   }
   }
   catch (PDOException $e) {
   echo $e->getMessage();
   exit;
  }
}

 var_dump($date);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>お知らせの追加 | Crescent Shoes 管理</title>
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
    <h1>お知らせの追加</h1>
    <p>情報を入力し、「追加」ボタンを押してください。</p>
    <form action="" method="post" enctype="multipart/form-data">
    <table>
      <tr>
        <th class="fixed">日付(任意)</th>
        <td>
          <?php if (isset($dateError)): ?>
          <div class="error"><?php echo h($dateError); ?></div>
          <?php endif; ?>
          <input type="date" name="posted" value="<?php echo h($date); ?>">
        </td>
      </tr>
      <tr>
        <th class="fixed">タイトル</th>
        <td>
          <?php if (isset($titleError)): ?>
            <div class="error"><?php echo h($titleError); ?></div>
          <?php endif; ?>
          <input type="text" name="title" size="80" value="<?php echo h($title); ?>">
        </td>
      </tr>
      <tr>
        <th class="fixed">お知らせの内容</th>
        <td>
         <?php if (isset($messageError)): ?>
          <div class="error"><?php echo h($messageError); ?></div>
         <?php endif; ?>
          <textarea name="message" cols="80" rows="5"><?php echo h($message); ?></textarea>
        </td>
      </tr>
      <tr>
        <th class="fixed">画像(任意)</th>
        <td>
         <?php if (isset($imageError)): ?>
           <div class="error"><?php echo h($imageError); ?></div>
         <?php endif; ?>
          <input type="file" name="image">
          <div>画像は64x64ピクセルで表示されます</div>
        </td>
      </tr>
    </table>
    <p>
      <input type="submit" name="add" value="追加">
      <input type="submit" name="cancel" value="キャンセル">
    </p>
    </form>
  </main>
  <footer>
    <p>&copy; Crescent Shoes All rights reserved.</p>
  </footer>
</div>
</body>
</html>