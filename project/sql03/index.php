<?php

$c = $_GET["c"];

try {
 // MySQL への接続
 $pdo = new PDO("mysql:host=localhost;dbname=blog",
"sysuser", "secret");
 // エラーモードを例外モードに設定
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 // 文字コードの設定
 $pdo->exec("SET NAMES utf8");

$stmt = $pdo->query("select name from categories;");
$categoryList = $stmt->fetchAll(PDO::FETCH_ASSOC);

}
 catch (PDOException $e) {
 echo $e->getMessage();
 exit;
 }


if ($c == 0) {

  try {

  $stmt = $pdo->query("select title, created, name, article from articles join categories on category_id = categories.id order by created desc;");
  $blogList = $stmt->fetchAll(PDO::FETCH_ASSOC);

  }
   catch (PDOException $e) {
   echo $e->getMessage();
   exit;
   }

} else {
  try {
  $stmt = $pdo->query("select title, created, name, article from articles join categories on category_id = categories.id where category_id = $c order by created desc;");
  $blogList = $stmt->fetchAll(PDO::FETCH_ASSOC);

  }
   catch (PDOException $e) {
   echo $e->getMessage();
   exit;
   }
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Taro's Blog</title>
    <link href="common.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="container">
        <div id="header">
            <h1><a href="index.php?c=0">Taro's Blog</a></h1>
        </div>
        <div id="main">
            <?php foreach ($blogList as $blog): ?>
            <div class="article">
                <div class="title">
                    <h2>
                        <?php echo $blog["title"]; ?>
                    </h2>
                    <h3>
                        <?php echo $blog["created"]; ?> |
                        <?php echo $blog["name"]; ?>
                    </h3>
                </div>
                <div class="text">
                    <?php echo $blog["article"]; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div id="side">
            <div class="sidebox">
                <h2>カテゴリ</h2>
                <ul>
                    <?php for($i = 0; $i < count($categoryList); $i++): ?>
                    <li><a href="index.php?c=<?php echo ($i+1); ?>">
                            <?php echo $categoryList[$i][name]; ?></a></li>
                    <?php endfor; ?>
                </ul>
            </div>
            <p class="right"><a href="post_article.php">記事の投稿</a></p>
            <p class="right"><a href="post_category.php">カテゴリーの投稿</a></p>
        </div>
    </div>
</body>

</html>