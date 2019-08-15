<?php

require_once "util.inc.php";

$greeting = "おはよう";

echo h($greeting);
?>
<br>
<?php
$greeting = "こんにちは";
echo h($greeting);
?>
<br>
<?php
const DAYS_IN_WEEK = 7;
echo h(DAYS_IN_WEEK);
 ?>
 <br>
<?php
$x = "好きな果物は";
$y = "りんごです。";
$x = $x.$y;
echo h($x);
 ?>