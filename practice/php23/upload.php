<?php
// ファイルのアップロード
if ($_SERVER["REQUEST_METHOD"] === "POST") {
 if ($_FILES["userfile"]["error"] == UPLOAD_ERR_OK) {
 $name = $_FILES["userfile"]["name"];
 // ファイル名の文字コードを CP932 に変換する
 $name = mb_convert_encoding($name, "cp932", "utf8");
 $temp = $_FILES["userfile"]["tmp_name"];
 // アップロードされたファイルを uploads フォルダの中に保存する
 $result = move_uploaded_file($temp, "uploads/" . $name);
 if ($result == TRUE) {
 $message = "ファイルをアップロードしました";
 }
 else {
 $message = "ファイルの移動に失敗しました";
 }
 }
 elseif ($_FILES["userfile"]["error"] == UPLOAD_ERR_NO_FILE) {
 $message = "ファイルがアップロードされませんでした";
 }
 else {
 $message = "ファイルのアップロードに失敗しました";
 }
}
?>
<html>
<body>
<?php if (isset($message)): ?>
<p><?php echo $message; ?></p>
<?php endif; ?>
<form action="" method="post" enctype="multipart/form-data">
<p>ファイル：<input type="file" name="userfile"></p>
<p><input type="submit" value="送信"></p>
</form>
</body>
</html>