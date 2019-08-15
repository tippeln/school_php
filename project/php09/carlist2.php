<?php
/**
 * 中古車リストの表示
 */
require_once "util.inc.php";

$cars = array(
  array(
    "maker" => "トヨタ",
    "model" => "プリウス",
    "year"  => 2004,
    "price" => 1100000),
  array(
    "maker" => "ホンダ",
    "model" => "アコード",
    "year"  => 2009,
    "price" => 2200000),
  array(
    "maker" => "日産",
    "model" => "マーチ",
    "year"  => 2003,
    "price" => 580000),
  array(
    "maker" => "ポルシェ",
    "model" => "ボクスター",
    "year"  => 2008,
    "price" => 4500000),
  array(
    "maker" => "BMW",
    "model" => "Z8",
    "year"  => 2002,
    "price" => 12500000),
);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>中古車リスト</title>
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
</style></head>
<body>
<table>
  <caption>forを使ったテーブル</caption>
  <tr>
    <th>メーカー</th>
    <th>モデル</th>
    <th>年式</th>
    <th>価格</th>
  </tr>
  <?php for ($i=0; $i<count($cars); $i++): ?>
  <tr>
    <td><?php echo $cars[$i]["maker"]; ?></td>
    <td><?php echo $cars[$i]["model"]; ?></td>
    <td><?php echo getWareki($cars[$i]["year"]); ?></td>
    <td><?php echo $cars[$i]["price"]; ?>円</td>
  </tr>
  <?php endfor; ?>
</table>

<table>
  <caption>foreachを使ったテーブル</caption>
  <tr>
    <th>メーカー</th>
    <th>モデル</th>
    <th>年式</th>
    <th>価格</th>
  </tr>
  <?php foreach ($cars as $car): ?>
  <tr>
    <td><?php echo $car["maker"]; ?></td>
    <td><?php echo $car["model"]; ?></td>
    <td><?php echo getWareki($car["year"]); ?></td>
    <td><?php echo $car["price"]; ?>円</td>
  </tr>
  <?php endforeach; ?>
</table>
</body>
</html>
