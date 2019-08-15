<?php
// 日本語の曜日を配列で準備
$weekday = array("日", "月", "火", "水", "木", "金", "土");
$date = new DateTime();
$index = $date->format('w'); // 配列の添え字になる曜日の番号を取得
$w = $weekday[$index]; // 日本語の曜日を取得
echo $date->format(' Y 年 n 月 j 日'); //年月日を出力
echo "({$w})"; // 曜日を出力
?>