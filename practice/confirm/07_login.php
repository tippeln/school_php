<?php
require_once "util.inc.php";
// session_start();
// // 既にログイン認証済みの場合は会員専用ページへ移動
// if($_SESSION["authenticated"] == TRUE) {
// header("Location: memberonly.php");
//  exit;
// }
s("07_member.php");
// ユーザIDを格納する変数（$user）の初期化
$user = "";
$loginError = "";
$valError = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
$user = $_POST["user"];
$pass = $_POST["pass"];

if ($_POST["user"] === "tippeln" and $_POST["pass"] === "abcd") {
 $_SESSION["authenticated"] = TRUE;
 $_SESSION["user"] = $user;
header("Location: 07_member.php");
 exit;

}elseif (!preg_match("/^[a-zA-Z0-9_\-.]{3,15}$/", $user)) {
    $loginError = "半角英数字で入力してください。";
} else { // ログイン認証に失敗
 // $loginErrorにエラーメッセージを設定
    $loginError = "ユーザIDかパスワードが正しくありません";
}
}
var_dump($_SESSION["user"]);
var_dump($loginError);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>ログイン</title>
<style>
.error {
 color: #f00;
}
</style>
</head>
<body>
<h1>ログイン</h1>
<?php if (isset($loginError)): ?>
<p class="error"><?php echo h($loginError); ?></p>
<?php endif; ?>
<p>ユーザIDとパスワードを入力して「ログイン」ボタンを押してください</p>
<form action="" method="post">
<p>ユーザーID<input type="text" name="user" value="<?php echo h($user); ?>"></p>
<p>パスワード<input type="password" name="pass"></p>
<p><input type="submit" value="ログイン"></p>
</form>