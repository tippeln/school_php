<?php
require_once "util.inc.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $num = $_POST["num"];
    $size = $_POST["size"];
    if ($_FILES["userfile"]["error"] == UPLOAD_ERR_OK) {
        $name = $_FILES["userfile"]["name"];
        $name = mb_convert_encoding($name, "cp932", "utf8");
        $temp = $_FILES["userfile"]["tmp_name"];
        $result = move_uploaded_file($temp, "uploads/" . $name);

        if ($result == FALSE) {
          $errorMessage = "アップロードされたファイルはありません。";
        }
    } elseif($_FILES["userfile"]["error"] == UPLOAD_ERR_NO_FILE) {
     // 何もしない
    } else {
      $errorMessage = "ファイルのアップロードに失敗しました";
    }
} else {
    $num = 5;
    $size = 200;
}

$files = glob("uploads/*");/* uploadsフォルダからファイルの一覧を取得 */
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>画像ギャラリー</title>
<style>
table {
 border: 1px solid #666666;
 border-collapse: collapse;
 /*width: 00px;*/
}
th {
 border: 1px solid #666666;
 background-color: #dddddd;
 padding: 4px;
}
td {
 border: 1px solid #666666;
 padding: 4px;
 text-align: center;
 width: <?php echo h($size); ?>px;
}
.error {
 color: #ff0000;
}
</style>
</head>
<body>
<h1>画像ギャラリー</h1>


<form action="" method="post" enctype="multipart/form-data">
<p>ファイル： <input type="file" name="userfile"></p>
<p>横並びの数: <input type="radio" name="num" value="3" <?php if($num == 3): echo checked; endif; ?>>3&nbsp;
<input type="radio" name="num" value="4" <?php if($num == 4): echo checked; endif; ?>>4&nbsp;
<input type="radio" name="num" value="5" <?php if($num == 5): echo checked; endif; ?>>5&nbsp;
<input type="radio" name="num" value="6" <?php if($num == 6): echo checked; endif; ?>>6&nbsp;
<input type="radio" name="num" value="7" <?php if($num == 7): echo checked; endif; ?>>7&nbsp;
<input type="radio" name="num" value="8" <?php if($num == 8): echo checked; endif; ?>>8</p>

<p>画像サイズ： <select name="size">
    <option value="100" <?php if($size == 100): echo selected; endif; ?>>100</option>
    <option value="150" <?php if($size == 150): echo selected; endif; ?>>150</option>
    <option value="200" <?php if($size == 200): echo selected; endif; ?>>200</option>
    <option value="300" <?php if($size == 300): echo selected; endif; ?>>300</option>
</select></p>
<p><input type="submit" value="送信"></p>

<?php if (isset($errorMessage)): ?>
<p class="error"><?php echo h($errorMessage); ?></p>
<?php endif; ?>

<table>
 <tr>
 <th colspan=<?php echo h($num) ?>>画像一覧</th>
 </tr>
 <?php if (count($files) > 0): ?>
    <tr>
 <?php
 for($i=0; $i < count($files); $i++):
    $file = mb_convert_encoding($files[$i], "utf8", "cp932");
    $replace = str_replace('uploads/', '', $files[$i]);
    $replace = str_replace('.png', '', $replace);
    $replace = str_replace('.jpg', '', $replace);
?>

<td> <img src="<?php echo h($files[$i]); ?>" width="<?php echo h($size) ?>"><br>
<?php echo h($replace); ?></td>
<?php if(($i+1) % $num == 0): ?>
    </tr><tr>
<?php endif; ?>
<?php endfor; ?>
  </tr>
 <?php else: //アップロードされた画像がない場合?>
 <tr>
 <td>アップロードされたファイルはありません。</td>
 </tr>
 <?php endif; ?>
</table>
</body>
</html>

