<?php
// 自分自身に送信するフォーム
// 一行入力ボックスでフォーム送信後の画面でも
// ユーザが入力した情報を表示する
$user = $_POST["user"];
?>
<html>
<body>
<p>こんにちは<?php echo $user; ?>さん！</p>
<form action="" method="post">
<p>名前：<input type="text" name="user" value="<?php echo $user; ?>"></p>
<p><input type="submit" value="送信"></p>
</form>
</body>
</html>
