<?php
session_start();
function getToken() {
return hash('sha256',session_id());
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
// ID を持っていない、もしくは ID と値が違う場合は購入の処理が行われない
if(!isset($_POST['token']) || $_POST['token'] !== getToken()){
exit('処理を正常に完了できませんでした');
}
$unit = $_POST["unit"];
$price = 21000 * $unit;
}
else{
header('Location: cart.php');
}
?>
<!DOCTYPE html>
<meta charset="utf-8">
<title>Web ストア</title>
</head>
<body>
<h1>購入商品</h1>
<table border="1">
 <tr>
 <th>商品</th>
 <th>個数</th>
 <th>お支払い金額</th>
 </tr>
 <tr>
 <td>3WAY スピーカー (SP-350T)</td>
 <td><?php echo $unit; ?>個</td>
 <td><?php echo $price; ?>円</td>
 </tr>
</table>
<p>お買い上げ、ありがとうございました。</p>
</body>
</html>