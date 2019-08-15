<?php
$date = new DateTime();
$date->modify('-10 days');
echo $date->format('Y-m-d');
?>

<?php
$date = new DateTime('-10 days');
echo $date->format('Y-m-d');
?>