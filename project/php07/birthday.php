<?php
// 配列の要素をリストとして表示する
// <ul>
// <li>リンゴ</li>
// <li>バナナ</li>
// <li>ぶどう</li>
// </ul>
echo "<h1>生年月日の入力</h1>";
echo "<select name = 'year'>";
for ($y = 1910; $y <= 2010 ; $y++) {
    echo "<option>" . $y . "</option>" ;
}
echo "</select>";

echo "<select name = 'month'>";
for ($m = 1; $m <= 12 ; $m++) {
    echo "<option>" . $m . "</option>" ;
}
echo "</select>月";

echo "<select name = 'day'>";
for ($d = 1; $d <= 31 ; $d++) {
    echo "<option>" . $d . "</option>" ;
}
echo "</select>日";
?>
