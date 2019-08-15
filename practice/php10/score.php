<?php
// 数値でない場合は「数値を入力してください」と表示
// 100 点より高い点数の場合は「不正な点数です」と表示
// 0 点より低い点数の場合は「不正な点数です」と表示
// 100 点の場合は「満点おめでとう！」と表示
// 80 点以上の場合は「素晴らしいです！」と表示
// 60 点以上の場合は「合格です」と表示
// 60 点未満の場合は「不合格です」と表示
$score = $_POST["score"];
if (!is_numeric($score)) {
 $result = "数値を入力してください";
}
elseif ($score > 100 or $score < 0) {
 // 異常処理
 $result = "不正な点数です";
}
else {
 // 正常処理
 if ($score == 100) {
 $result = "満点おめでとう！";
 }
 elseif ($score >= 80) {
 $result = "素晴らしいです！";
 }
 elseif ($score >= 60) {
 $result = "合格です";
 }
 else {
 $result = "不合格です";
 }
}
?>
<html>
<body>
<h1>テスト結果判定</h1>
<form action="" method="post">
<p>点数：
 <input type="text" name="score" value="<?php echo $score; ?>">点
 <input type="submit" value="判定">
</p>
</form>
<?php if ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
<p>判定： <?php echo $result; ?></p>
<?php endif; ?>
</body>
</html>