<?php
session_start();
// セッション変数を読み出す
if (isset($_SESSION["user"])) {
 $user = $_SESSION["user"];
}
else {
 // 入力画面へ移動する
 header("Location: input.php");
 exit;
}
// 「送信」ボタンが押された場合の処理
if (isset($_POST["send"])) {
 // 登録作業等
 // セッション変数を破棄する
 unset($_SESSION["user"]);
 // 完了画面へ移動する
 header("Location: input_done.php");
 exit;
}
// 「修正」ボタンが押された場合の処理
if (isset($_POST["back"])) {
 // 入力ページへ戻る
 header("Location: input.php");
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
<h1>確認画面</h1>
<p>氏名：<?php echo $user; ?></p>
<form action="" method="post">
<p>
 <input type="submit" name="send" value="送信">
 <input type="submit" name="back" value="修正">
</p>
</form>
</body>
</html>
