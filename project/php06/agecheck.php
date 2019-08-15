<?php
// 数値でない場合は「数値を入力してください」と表示
// 100 点より高い点数の場合は「不正な点数です」と表示
// 0 点より低い点数の場合は「不正な点数です」と表示
// 100 点の場合は「満点おめでとう！」と表示
// 80 点以上の場合は「素晴らしいです！」と表示
// 60 点以上の場合は「合格です」と表示
// 60 点未満の場合は「不合格です」と表示
$age = $_POST["age"];
if (!is_numeric($age)) {
 $message = "エラー： 数字を入力してください。";
}
elseif ($age < 0) {
 // 異常処理
 $message = "エラー：0 以上の数字を入力してください。";
}
else {
 // 正常処理
 if ($age >= 20) {
 $message = "お酒を飲んでも大丈夫です！";
 }
 else {
 $message = "お酒を飲んではいけません！";
 }
}
?>
<html>
<body>
<h1>年齢確認</h1>
年齢を入植して「チェック！」ボタンを押してください。
<form action="" method="post">
<p>年齢：<input type="text" name="age" value="<?php echo $age; ?>">
 <input type="submit" value="チェック！">
</p>
</form>
<?php if ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
<p>判定： <?php echo htmlspecialchars ($message, ENT_QUOTES); ?></p>
<?php endif; ?>
</body>
</html>