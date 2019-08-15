<?php
$d1 = new DateTime('2020-08-27');
$d2 = new DateTime('2020-08-03');
$interval = $d1->diff($d2);
var_dump($interval);
$days = $interval->days; //日数の差を取得
$invert = $interval->invert; //$d1 の方が新しい場合は「1」
if ($days == 0) {
echo '日付は同じです';
} else {
if ($invert == 1) {
echo 'd1 の方が「'. $days. '日」新しいです';
} else {
echo 'd2 の方が「'. $days. '日」新しいです';
}
}
?>
