<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
$lang = $_POST["lang"];
}
elseif(isset($_COOKIE["lang"])) {
$lang = $COOKIE["lang"];
}
else {
$lang = "ja";
}
var_dump($lang);
setcookie("lang", $lang, time() + 86400*30);

if ($lang == "ja") {
$message = "ようこそ";
}
elseif ($lang == "en") {
$message = "Welcome!";
}
else {
$message = "Benvenuto!";
}
var_dump($message);

 ?>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title><?php $message ?></title>
</head>
<body>

 <h1><?php echo $message; ?></h1>
<form action="" method="post">
<select name="lang">
 <option value="ja"<?php if ($lang === "ja") echo "selected"; ?>>日本語</option>
 <option value="en"<?php if ($lang === "en") echo "selected"; ?>>English</option>
 <option value="it"<?php if ($lang === "it") echo "selected"; ?>>Italia</option>

</select>
<p><input type="submit" value="送信"></p>
</form>


</body>
</html>




