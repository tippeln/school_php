<?php
session_start();
// 秘密の ID を作るための関数
function getToken() {
 // セッション ID を作成し、hash で暗号化(sha256)する
return hash('sha256',session_id());
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>Web ストア</title>
</head>
<body>
<h1>ショッピングカート</h1>
<form action="purchase.php" method="post">
<table border="1">
 <tr>
 <th>商品</th>
 <th>価格</th>
 <th>個数</th>
 </tr>
 <tr>
 <td>3WAY スピーカー (SP-350T)</td>
 <td>21,000 円</td>
 <td>
 <select name="unit">
 <option selected>1</option>
 <option>2</option>
 <option>3</option>
 </select>個
 </td>
 </tr>
</table>
<!-- 隠しフォームで次のページに値を送る -->
<input type="hidden" name="token" value="<?php echo getToken(); ?>">
<p><input type="submit" value="購入"></p>
</form>
</body>
</html>