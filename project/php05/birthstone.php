<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>誕生石</title>
</head>
<body>
<?php
$birthstone = array(
    "",
"ガーネット",
"アメジスト",
"アクアマリン",
"ダイヤモンド",
"エメラルド",
"パール",
"ルビー",
"ペリドット",
"サファイア",
"オパール",
"トパーズ",
"ターコイズ"
);
var_dump($_POST);
$month = $_POST["month"];
$stone = $birthstone[$month] ;

 ?>


<h1>誕生石</h1>

<p><?php echo htmlspecialchars($month, ENT_QUOTES); ?>月の誕生石は<?php echo htmlspecialchars($stone, ENT_QUOTES); ?>です！</p>
   <form action="" method="post">
<p>誕生月を選んでください
<select name="month">
<option value="1">1月</option>
<option value="2">2月</option>
<option value="3">3月</option>
<option value="4">4月</option>
<option value="5">5月</option>
<option value="6">6月</option>
<option value="7">7月</option>
<option value="8">8月</option>
<option value="9">9月</option>
<option value="10">10月</option>
<option value="11">11月</option>
<option value="12">12月</option>
</select>
<input type="submit" value="送信">
</p>
   </form>

</body>
</html>



