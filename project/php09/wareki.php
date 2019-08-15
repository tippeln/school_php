<?php

$seireki = $_POST["seireki"];
require_once "util.inc.php";
$wareki = getWareki($seireki);
$string = '$seireki';
var_dump($string);

?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<h1>西暦⇒和暦返還</h1>
<p>西暦を入力し、「計算」ボタンを押してください</p>
<form action="" method="post">
<p>西暦<input name="seireki">年</p>
<p><input type="submit" value="計算"></p>
</form>
<p>西暦<?php echo h($seireki); ?>年は、<?php echo h($wareki); ?>です。</p>

</body>
</html>


