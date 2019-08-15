<?php
require_once "util.inc.php";
require_once "db.inc.php";
require_once "auth.inc.php";


define("IMAGE_PATH", "../images/press/");

session_start();
if ($_SESSION["admin_login"] != TRUE) {
    header("Location: login.php");
    exit;
}
auth_confirm();

if (isset($_GET["id"])) {
  //--------------------
  // IDの取得
  //--------------------
  $id = $_GET["id"];

  try {
    //--------------------
    // データベースの準備
    //--------------------
    $pdo = db_init();

    //--------------------
    // お知らせ情報の取得
    //--------------------
    $sql = "SELECT * FROM news WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($id));
    $news = $stmt->fetch();
    if ($news != FALSE) {
      $posted  = $news["posted"];
      $title   = $news["title"];
      $message = $news["message"];
      $image   = $news["image"];

      //--------------------
      // 「保存」ボタン
      //--------------------
      if (isset($_POST["save"])) {
        // バリデーションフラグの初期化
        $isValidated = TRUE;

        // 送信値の取得
        $posted    = $_POST["posted"];
        $title     = $_POST["title"];
        $message   = $_POST["message"];

        // 日付のバリデーション
        if ($posted === "" || mb_ereg_match("^(\s|　)+$", $posted)) {
          $posted  = date("Y-m-d");
        }
        elseif (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $posted)) {
          $errorPosted = "※日付は「0000-00-00」の形式で入力してください";
          $isValidated = FALSE;
        }

        // タイトルのバリデーション
        if ($title === "" || mb_ereg_match("^(\s|　)+$", $title)) {
          $errorTitle = "※タイトルを入力してください";
          $isValidated = FALSE;
        }

        // お知らせ内容のバリデーション
        if ($message === "" || mb_ereg_match("^(\s|　)+$", $message)) {
          $errorMessage = "※お知らせ内容を入力してください";
          $isValidated = FALSE;
        }

        // 画像アップロードのバリデーション
        if ($_FILES["image"]["error"] == UPLOAD_ERR_OK) {
          $image = mb_convert_encoding($_FILES["image"]["name"], "cp932", "utf8");
          $temp = $_FILES["image"]["tmp_name"];

          if (!move_uploaded_file($temp, IMAGE_PATH . $image)) {
            $errorImage = "ファイルのアップロードに失敗しました";
            $isValidated = FALSE;
          }
        }
        elseif ($_FILES["image"]["error"] == UPLOAD_ERR_NO_FILE) {
        // 何もしない
        }
        else {
          $errorImage = "ファイルのアップロードに失敗しました";
          $isValidated = FALSE;
        }

        if ($isValidated == TRUE) {
          // バリデーション成功
          // データベースを更新
          $sql = "UPDATE news SET posted=?, title=?, message=?, image=? WHERE id=?";
          $stmt = $pdo->prepare($sql);
          $stmt->execute(array($posted, $title, $message, $image, $id));
          // 完了ページへ移動
          header("Location: news_edit_done.php");
          exit;
        }
      }

      //--------------------
      // 「キャンセル」ボタン
      //--------------------
      if (isset($_POST["cancel"])) {
        // お知らせ一覧へ移動
        header("Location: index.php");
        exit;
      }

    }
    else {
      $idError = "指定されたお知らせは存在しません。";
    }
  }
  catch (PDOException $e) {
    echo $e->getMessage();
    exit;
  }
}
else {
  $idError = "お知らせが指定されていません。";
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>お知らせの編集 | Crescent Shoes 管理</title>
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
    <h1>お知らせの編集</h1>
    <?php if (isset($idError)): ?>
    <?php echo h($idError); ?>
    <p><a href="index.php">お知らせ一覧へ戻る</a></p>
    <?php else: ?>
    <p>情報を入力し、「保存」ボタンを押してください。</p>
    <form action="" method="post" enctype="multipart/form-data">
    <table>
      <tr>
        <th class="fixed">日付(任意)</th>
        <td>
          <?php if (isset($errorPosted)): ?>
          <div class="error"><?php echo h($errorPosted); ?></div>
          <?php endif; ?>
          <input type="date" name="posted"  value="<?php echo h($posted); ?>">
        </td>
      </tr>
      <tr>
        <th class="fixed">タイトル</th>
        <td>
          <?php if (isset($errorTitle)): ?>
          <div class="error"><?php echo h($errorTitle); ?></div>
          <?php endif; ?>
          <input type="text" name="title" size="80" value="<?php echo h($title); ?>">
        </td>
      </tr>
      <tr>
        <th class="fixed">お知らせの内容</th>
        <td>
          <?php if (isset($errorMessage)): ?>
          <div class="error"><?php echo h($errorMessage); ?></div>
          <?php endif; ?>
          <textarea name="message" cols="80" rows="5"><?php echo h($message); ?></textarea>
        </td>
      </tr>
      <tr>
        <th class="fixed">画像(任意)</th>
        <td>
          <?php if (isset($errorImage)): ?>
          <div class="error"><?php echo h($errorImage); ?></div>
          <?php endif; ?>
          <input type="file" name="image">
          <div>
                    <?php if($image): ?>
          <img src="<?php echo IMAGE_PATH . h($image); ?>" width="64" height="64" alt="">
        <?php else: ?>
          <img src="../images/press.png" width="64" height="64" alt="">
        <?php endif; ?>


          </div>
        </td>
      </tr>
    </table>
    <p>
      <input type="submit" name="save" value="保存">
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