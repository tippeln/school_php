<?php
require_once "Chart.class.php";

$s = $_POST;
var_dump($s);

$data = array($s1, $s2, $s3, $s4);
$label = array("春", "夏" , "秋", "冬");
$c = new Chart();
$c->setTitle("日本の人口推移");
$c->addData($data);
$c->setXLabel($label);
$c->setXAxisName("季節");
$c->setYAxisName("(人)");
$c->setSize(300, 200);
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>集計結果</title>
</head>
<body>
    <h1>集計結果入力</h1>

<form action="" method="post">
<p>春<input type="text" name="s">人</p>
<p>夏<input type="text" name="s">人</p>
<p>秋<input type="text" name="s">人</p>
<p>冬<input type="text" name="s">人</p>
 <p><input type="submit" value="グラフ生成"></p>
</form>
<?php $c->printBarChart(); ?>
</body>
</html>

