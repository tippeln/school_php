<?php
require_once "util.inc.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if ($_FILES["userfile"]["error"] == UPLOAD_ERR_OK) {
 $name = $_FILES["userfile"]["name"];
 // ファイル名の文字コードを CP932 に変換する
 $name = mb_convert_encoding($name, "cp932", "utf8");
 $temp = $_FILES["userfile"]["tmp_name"];
 // アップロードされたファイルを uploads フォルダの中に保存する
 $result = move_uploaded_file($temp, "uploads/" . $name);
    var_dump($temp);
    var_dump($name);



        if ($result == FALSE) {
          $errorMessage = "アップロードされたファイルはありません。";
        }

    } elseif($_FILES["userfile"]["error"] == UPLOAD_ERR_NO_FILE) {
     // 何もしない
    } else {
      $errorMessage = "ファイルのアップロードに失敗しました";

    }
}
$files = glob("uploads/*.jpg");/* uploadsフォルダからファイルの一覧を取得 */
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
 width: 600px;
}
th {
 border: 1px solid #666666;
 background-color: #dddddd;
 padding: 4px;
}
td {
 border: 1px solid #666666;
 padding: 4px;
}
.error {
 color: #ff0000;
}
</style>
</head>
<body>
<h1>画像ギャラリー</h1>

<form action="" method="post" enctype="multipart/form-data">
<p>ファイル：<input type="file" name="userfile"></p>
<p><input type="submit" value="送信"></p>

<?php if (isset($errorMessage)): ?>
<p class="error"><?php echo h($errorMessage); ?></p>
<?php endif; ?>

<table>
 <tr>
 <th>画像一覧</th>
 </tr>
 <?php if (count($files) > 0): ?>
 <?php foreach ($files as $file): ?>
 <?php $file = mb_convert_encoding($file, "utf8", "cp932"); ?>
 <?php var_dump($file); ?>
 <?php var_dump($files); ?>
 <tr>
 <td><img src="<?php echo h($file); ?>" width="200"></td>
 </tr>
 <?php endforeach; ?>
 <?php else: //アップロードされた画像がない場合?>
 <tr>
 <td>アップロードされたファイルはありません。</td>
 </tr>
 <?php endif; ?>
</table>
</body>
</html>
