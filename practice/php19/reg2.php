<?php
// 郵便番号かどうかチェックする
$text = "123-4567";
# if (preg_match("/^¥d¥d¥d-¥d¥d¥d¥d$/", $text)) {
if (preg_match("/^\d\d\d-\d\d\d\d$/", $text)) {
 echo "YES";
}
else {
 echo "NO";
}
?>