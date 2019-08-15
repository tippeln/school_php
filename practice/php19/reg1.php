<?php
// 携帯電話の番号かどうかチェックする
// => 080 か 090 で始まる文字列かどうか
$text = "03012345678";
if (preg_match("/^0[89]0/", $text)) {
 echo "YES";
}
else {
 echo "NO";
}
?>