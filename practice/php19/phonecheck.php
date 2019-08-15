<?php
// 携帯電話番号かどうかをチェックする
// ⇒ 080 か 090 で始まる 11 桁の数字
$number = $_POST["number"];
if (preg_match("/^0[89]0\d{8}/", $number)) {
 $result = "携帯電話です";
}
else {
 $result = "携帯電話ではありません";
}
?>
<html>
<body>
<h1>電話番号チェッカー</h1>
<form action="" method="post">
<p>電話番号：
<input type="tel" name="number" value="<?php echo $number; ?>" autofocus>
</p>
<p><input type="submit" value="チェック"></p>
</form>
<?php if ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
<p>結果：<?php echo $result; ?></p>
<?php endif; ?>
</body>
</html>