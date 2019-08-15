<?php
/**
 * 入力された数量から金額を計算する
 */

//--------------------
// 商品情報
//--------------------
$goods["name"] = "和風柄レターセット";
$goods["unitPrice"] = 980;

//--------------------
// 購入数量の取得
//--------------------
$count = $_POST["count"];

//--------------------
// 小計の計算
//--------------------
$totalPrice = $goods["unitPrice"] * $count;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>ショッピングカート</title>
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
</style>
</head>
<body>
<h1>ショッピングカート</h1>
<form action="" method="post">
<table>
  <tr>
    <th>商品名</th>
    <th>単価</th>
    <th>数量</th>
    <th>小計</th>
  </tr>
  <tr>
    <td><?php echo htmlspecialchars($goods["name"], ENT_QUOTES); ?></td>
    <td><?php echo htmlspecialchars($goods["unitPrice"], ENT_QUOTES); ?>円</td>
    <td><input type="text" name="count" value="<?php echo htmlspecialchars($count, ENT_QUOTES); ?>"></td>
    <td><?php echo htmlspecialchars($totalPrice, ENT_QUOTES); ?>円</td>
  </tr>
</table>
<p><input type="submit" value="更新"></p>
</form>
</body>
</html>
