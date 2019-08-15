<?php
require_once "util.inc.php";
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
         text-align: center;
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
    <h1>九九表</h1>
<table><tr>        <th></th>
<?php for($i = 1; $i <= 9; $i++): ?>
<th><?php echo h($i); ?></th>
<?php endfor; ?>

</tr>
<?php for ($i = 1;$i <= 9; $i++): ?>
        <tr><th><?php echo h($i); ?></th>
<?php for ($j = 1;$j <= 9; $j++): ?>
<td><?php echo h($i * $j); ?></td>
<?php  endfor;  ?>
</tr>
<?php  endfor;  ?>
</table>
</body>
</html>