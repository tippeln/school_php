<?php
$user = $_POST["user"];
$pass = $_POST["pass"];
$id = $_POST["id"];
 ?>
 <!DOCTYPE html>
 <html lang="ja">
 <body>
<p><?php echo $user; ?>さん、こんにちは！</p>
 <p>あなたのパスワードは「 <?php echo $pass; ?>」</p>
<p>ID: <?php echo $id; ?></p>
</body>
 </html>