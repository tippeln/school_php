<?php

require_once "util.inc.php";

$result = 0;

for ($i = 1; $i <=30; $i++) {
$result += $i;
}
echo "合計は" .$result. "です。";
$result = 0;

for ($i = 1; $i <=100; $i++) {
    $arrNums[] = $i;
}
    var_dump($arrNums);
foreach ($arrNums as $arrNum) {
    $result = $result + $arrNum;
    var_dump($result);
}
echo "合計は" .$result. "です。";

 ?>