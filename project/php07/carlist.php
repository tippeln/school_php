<?php

$cars = array(
array(
"maker" => "トヨタ" ,
"model" => "プリウス",
"year" => 2004 ,
"price" => 1100000
) ,
array(
"maker" => "ホンダ" ,
"model" => "アコード" ,
"year" => 2009 ,
"price" => 2200000
) ,
array(
"maker" => "日産" ,
"model" => "マーチ" ,
"year" => 2003 ,
"price" => 580000
) ,
array(
"maker" => "ポルシェ" ,
"model" => "ボクスター" ,
"year" => 2008 ,
"price" => 4500000
) ,
array(
"maker" => "BMW" ,
"model" => "Z8" ,
"year" => 2002 ,
"price" => 12500000
)
);

echo "
 <style>
table {
 border: 1px solid #666666;
 border-collapse: collapse;
 width: 600px;
}
th,td {
 border: 1px solid #666666;
 padding: 4px;
}
th {
 background-color: #dddddd;
}
</style>
";

echo "<table border='1'><caption>forを使ったテーブル</caption>";
echo "<tr><th>メーカー</th><th>モデル</th><th>年式</th><th>価格</th></tr>";

for ($i = 0; $i < count($cars); $i++) {
echo "<tr>";
echo "<td>".$cars[$i]["maker"]."</td>";
echo "<td>".$cars[$i]["model"]."</td>";
echo "<td>".$cars[$i]["year"]."</td>";
echo "<td>".$cars[$i]["price"]."</td>";
echo "</tr>";
}
echo "</table>";



echo "<table border='1'><caption>foreachを使ったテーブル</caption>";
echo "<tr><th>メーカー</th><th>モデル</th><th>年式</th><th>価格</th></tr>";
foreach ($cars as $car) {
echo "<tr>";
echo "<td>".$car["maker"]."</td>";
echo "<td>".$car["model"]."</td>";
echo "<td>".$car["year"]."</td>";
echo "<td>".$car["price"]."</td>";
echo "</tr>";
}
echo "</table>";


 ?>
