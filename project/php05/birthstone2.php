<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>誕生石</title>
</head>
<body>
<?php
$birthstone = array(
1,
2,
3,
4,
5,
6,
7,
8,
9,
10,
11,
12
);

var_dump($_POST);
$stone = $_POST["stone"];
$month = $birthstone[$stone] ;

 ?>


<h1>誕生石</h1>

<p><?php echo htmlspecialchars($month, ENT_QUOTES); ?>月の誕生石は<?php echo htmlspecialchars($stone, ENT_QUOTES); ?>です！</p>
   <form action="" method="post">
<p>誕生月を選んでください
<select name="stone">
<option>ガーネット</option>
<option>アメジスト</option>
<option>アクアマリン</option>
<option>ダイヤモンド</option>
<option>エメラルド</option>
<option>パール</option>
<option>ルビー</option>
<option>ペリドット</option>
<option>サファイア</option>
<option>オパール</option>
<option>トパーズ</option>
<option>ターコイズ</option>
    </select>
<input type="submit" value="送信">
</p>
   </form>

</body>
</html>



