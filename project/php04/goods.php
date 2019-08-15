<?php
$id = $_GET["id"];

$goodsList = array("テレビ","パソコン","携帯電話","冷蔵庫","洗濯機");
?>

<?php
$itemName = $goodsList[$id];
?>
<p> <?php echo $itemName; ?>が選択されました</p>
<a href="index.php">一覧ページに戻る</a>



