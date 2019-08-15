<?php

function agehantei($name, $age)
{

if (!is_numeric($age)) {
return  "数字を入力してください。";
} elseif ($age <= 18) {
return  $name ."さんの年齢は". $age . "歳で未成年です";
} elseif($age >= 20) {
return  $name ."さんの年齢は". $age . "歳で成人です";
}
}
 ?>

<?php echo agehantei("太郎",21); ?>
<br>
<?php echo agehantei("太郎",18); ?>
<br>
<?php echo agehantei("太郎",aaa); ?>



