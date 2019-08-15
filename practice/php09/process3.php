<?php
$size = $_POST["size"];
$color = $_POST["color"];
$colorList = array("レッド","ブルー");

$color_s = $colorList[$color];
 ?>

 <!DOCTYPE html>
 <html lang="ja">
 <head>
     <meta charset="UTF-8">
     <title>Document</title>
 </head>
 <body>
    <p>サイズ：<?php echo $size; ?></p>
    <p>色：<?php echo $color_s; ?></p>

 </body>
 </html>