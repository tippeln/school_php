<?php
$lists = glob("images/*.jpg");
var_dump($lists);
$i = count($lists);
var_dump($i);
 ?>
 <!DOCTYPE html>
 <html lang="ja">
 <head>
     <meta charset="UTF-8">
     <title>PHPファイルリスト</title>
 </head>
 <body>
    <h1>PHPファイルリスト</h1>
    <ul>
     <?php foreach($lists as $list): ?>
     <li><img src= "<?php echo $list; ?>"></li>
<?php endforeach; ?>
    </ul>


 </body>
 </html>