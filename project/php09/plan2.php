<?php
require_once "tax.inc.php";
$price = calcPriceWithTax(267000);
?>
<?php require_once "header.inc.php"; ?>
<main>
 <h2>大人の時間を楽しむ、フランスの旅</h2>
 <p>料金：<?php echo $price; ?>円</p>
</main>