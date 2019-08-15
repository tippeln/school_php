<?php
/**
 * 入力された数量から金額を計算する
 */

//--------------------
// 商品情報
//--------------------
$goods1["name"] = "和風柄レターセット";
$goods1["unitPrice"] = 980;
$goods2["name"] = "毛筆ペン（細字）";
$goods2["unitPrice"] = 240;

//--------------------
// 購入数量の取得
//--------------------
$count1 = $_POST["count1"];
$count2 = $_POST["count2"];

//--------------------
// 小計の計算
//--------------------
$subTotal1 = $goods1["unitPrice"] * $count1;
$subTotal2 = $goods2["unitPrice"] * $count2;

//--------------------
// 合計の計算
//--------------------
$total = $subTotal1 + $subTotal2;
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
    <td><?php echo htmlspecialchars($goods1["name"], ENT_QUOTES); ?></td>
    <td><?php echo htmlspecialchars($goods1["unitPrice"], ENT_QUOTES); ?>円</td>
    <td><input type="text" name="count1" value="<?php echo htmlspecialchars($count1, ENT_QUOTES); ?>"></td>
    <td><?php echo htmlspecialchars($subTotal1, ENT_QUOTES); ?>円</td>
  </tr>
  <tr>
    <td><?php echo htmlspecialchars($goods2["name"], ENT_QUOTES); ?></td>
    <td><?php echo htmlspecialchars($goods2["unitPrice"], ENT_QUOTES); ?>円</td>
    <td><input type="text" name="count2" value="<?php echo htmlspecialchars($count2, ENT_QUOTES); ?>"></td>
    <td><?php echo htmlspecialchars($subTotal2, ENT_QUOTES); ?>円</td>
  </tr>
  <tr>
    <th colspan="3">合計</th>
    <td><?php echo htmlspecialchars($total, ENT_QUOTES); ?>円</td>
  </tr>
</table>
<p><input type="submit" value="更新"></p>
</form>
</body>
</html>
