<?php
// 郵便番号かどうかチェックする
$text = "123-4567";
if (preg_match("/^\d{3}-\d{4}$/", $text)) {
 echo "YES";
}
else {
 echo "NO";
}
?>