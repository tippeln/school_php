<?php

for ($i = 0; $i <= 4; $i++) {
echo $i;
}
echo "<br>";

for ($i = 3; $i <= 5; $i++) {
echo $i;
}
echo "<br>";

for ($i = 0; $i <= 5; $i++) {
echo $i. " ";
}
echo "<br>";

for ($i = 0; $i <=5; $i++) {
echo $i * $i;
echo $i. " ,";
}
echo "-";
echo "<br>";


for ($i = 1; $i <= 15; $i++) {
if ($i%5==0)  {
echo $i ."<br>";
 }
 else {
echo $i." " ;
}
}

for ($i = 1; $i <= 100; $i++) {
if (($i%3==0) and ($i%5==0)) {
echo $i .":FizzBuzz<br>";
}
elseif ($i%3==0)  {
echo $i .":Fizz<br>";
 }
elseif ($i%5==0)  {
echo $i .":Buzz<br>";
 }
 else {
echo $i." <br>" ;
}
}

 ?>
