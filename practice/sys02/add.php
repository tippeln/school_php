<?php
// 「追加」ボタンが押された場合の処理
if (isset($_POST["add"])) {
 $isValidated = TRUE;
 $user = $_POST["user"];
 if ($user === "") {
 $userError = "ユーザ名を入力してください";
 $isValidated = FALSE;
 }
 if ($isValidated == TRUE) {
 // データの追加（コード省略）
 // 完了画面へ移動
 header("Location: add_done.php");
 exit;
 }
}
// 「キャンセル」ボタンが押された場合の処理
if (isset($_POST["cancel"])) {
 // 基準画面へ移動
 header("Location: index.php");
 exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>会員管理システム</title>
</head>
<body>
<h1>ユーザの追加</h1>
<form action="" method="post">
<?php if (isset($userError)): ?>
<p><?php echo $userError; ?></p>
<?php endif; ?>
<p>
 ユーザ名：<input type="text" name="user">
</p>
<p>
 <input type="submit" name="add" value="追加">
 <input type="submit" name="cancel" value="キャンセル">
</p>
</form>
</body>
</html>
