<?php
require_once "util.inc.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
$name = $_POST["name"];
$age  = $_POST["age"];
$mail = $_POST["mail"];
} else {
$name = "";
$age = "";
$mail = "";
}

 ?>

 <!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>画像ギャラリー</title>
    <style>
        table {
         border: 1px solid #666666;
         border-collapse: collapse;
         /*width: 600px;*/
        }
        th {
         border: 1px solid #666666;
         background-color: #dddddd;
         padding: 4px;
                  width: 50px;

        }
        td {
         border: 1px solid #666666;
         padding: 4px;
         width: 50px;
        }
        .error {
         color: #ff0000;
        }
        figure {
            font-size: 10px;
            text-align: center;
            color: #777;
        }
    </style>
</head>
<body>
<form action="" method="post">
【名 前】<input type="text" name="name" value=<?php echo h($name); ?>><br />
【年 齢】<input type="text" name="age" value=<?php echo h($age); ?>><br />
【メール】<input type="text" name="mail" value=<?php echo h($mail); ?>><br />
<input type="submit" value="送信">
</form>
<?php if ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
<table>
 <tr><th>名前</th><th>年齢</th><th>メール</th></tr>
 <tr><td><?php echo h($name); ?></td><td><?php echo h($age); ?></td><td><?php echo h($mail); ?></td></tr>
</table>
<?php endif; ?>
</body>
</html>