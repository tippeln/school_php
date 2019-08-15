<?php
session_start();
// 初期化
$user = "";
// セッション変数が存在する場合は読み出す
if (isset($_SESSION["user"])) {
 $user = $_SESSION["user"];
}
// 「確認画面」ボタンが押された場合の処理
if (isset($_POST["confirm"])) {
 $isValidated = TRUE;
 $user = $_POST["user"];
 // バリデーション
 if ($user === "") {
 $userError = "※氏名を入力してください";
 $isValidated = FALSE;
 }
 // エラーが無ければ確認画面へ移動
 if ($isValidated == TRUE) {
 $_SESSION["user"] = $user;
 header("Location: input_conf.php");
 exit;
 }
}
// 「クリア」ボタンが押された場合の処理
if (isset($_POST["clear"])) {
 // セッション変数を破棄する
 unset($_SESSION["user"]);
 // 自分自身へ移動する
 header("Location: input.php");
 exit;
}
s?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>会員管理システム</title>
</head>
<body>
<h1>入力画面</h1>
<?php if (isset($userError)): ?>
<p><?php echo $userError; ?></p>
<?php endif; ?>
<form action="" method="post">
氏名：<input type="text" name="user" value="<?php echo $user; ?>">
<p>
 <input type="submit" name="confirm" value="確認画面">
 <input type="submit" name="clear" value="クリア">
</p>
</form>
</body>
</html>