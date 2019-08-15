<?php
require_once "Chart.class.php";
require_once "util.inc.php";

$s1 = $_POST["s1"];
$s2 = $_POST["s2"];
$s3 = $_POST["s3"];
$s4 = $_POST["s4"];

$data = array($s1, $s2, $s3, $s4);
$label = array("春", "夏" , "秋", "冬");
$switch = "false";
$c = new Chart();
$c->setTitle("好きな季節 アンケート結果");
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
<p>春<input type="text" name="s1" value="<?php echo h($s1); ?>">人</p>
<p>夏<input type="text" name="s2" value="<?php echo h($s2); ?>">人</p>
<p>秋<input type="text" name="s3" value="<?php echo h($s3); ?>">人</p>
<p>冬<input type="text" name="s4" value="<?php echo h($s4); ?>">人</p>
 <p><input type="submit" value="グラフ生成"></p>
</form>

<?php if ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
<?php $c->printBarChart(); ?>
<?php endif; ?>

</body>
</html>

