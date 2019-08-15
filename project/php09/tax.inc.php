<?php
// 消費税込みの金額を計算する
function calcPriceWithTax($price)
{
 $result = $price * 1.08;
 return $result;
}
