<?php
// 数値でない場合は「数値を入力してください」と表示
// 100 点より高い点数の場合は「不正な点数です」と表示
// 0 点より低い点数の場合は「不正な点数です」と表示
// 100 点の場合は「満点おめでとう！」と表示
// 80 点以上の場合は「素晴らしいです！」と表示
// 60 点以上の場合は「合格です」と表示
// 60 点未満の場合は「不合格です」と表示
$t = $_POST["t"];
$h = $_POST["h"];



if (!is_numeric($t) or !is_numeric($h)) {
$di = "エラー";
$result = "入力値が正しくありません";
}
elseif (($t < 0) or ($h < 0)) {
 // 異常処理
$di = "エラー";
$result = "入力値が正しくありません";
}
else {
 // 正常処理
$di = 0.81 * $t + 0.01 * $h * (0.99 * $t - 14.3) + 46.3;
 if ($di >= 85)  {
 $result = "暑くてたまらない";
 }
elseif (($di < 85) and ($di >= 80)) {
$result = "暑くて汗が出る";
}
elseif (($di < 80) and ($di >= 75)) {
$result = "やや暑い";
}
elseif (($di < 75) and ($di >= 70)) {
$result = "暑くない";
}
elseif (($di < 70) and ($di >= 65)) {
$result = "快い";
}
elseif (($di < 65) and ($di >= 60)) {
$result = "何も感じない";
}
elseif (($di < 60) and ($di >= 55)) {
$result = "肌寒い";
}
 else {
 $result = "寒い";
 }
}
?>
<html>
<body>
<h1>不快指数チェック</h1>
気温と湿度を入力して「判定」ボタンを押してください。
<form action="" method="post">
<p>気温：<input type="text" name="t" value="<?php echo $t; ?>">℃</p>
<p>湿度：<input type="text" name="h" value="<?php echo $h; ?>">℃</p>
<p>
 <input type="submit" value="判定">
</p>
</form>
<?php if ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
<p>不快指数： <?php echo htmlspecialchars ($di, ENT_QUOTES); ?></p>
<p>判定： <?php echo htmlspecialchars($result, ENT_QUOTES); ?></p>
<?php endif; ?>
</body>
</html>