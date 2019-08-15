<?php
// 「学年-クラス」の形式かどうかチェックする
// 学年： 1～6
// クラス： A,B,C
// 例：
// 1-A -> OK
// 3-C -> OK
// 7-A -> NG
// 2-a -> NG
$text = "7-A";
if (preg_match("/^[1-6]-[A-C]$/", $text)) {
    echo "YES";
} else {
    echo "NG";
}
 ?>