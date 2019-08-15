<?php

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


// フォームが送信された時のみデータを登録する
if ($_SERVER["REQUEST_METHOD"] === "POST") {
   // バリデーションフラグ
   $isValidated = TRUE;
   // 入力値の取得
   $category = $_POST["category"];
   $category += 1;
   $title = $_POST["title"];
   $article = $_POST["article"];

   // タイトルのバリデーション
   if ($title === "") {
   $titleError = "タイトルを入力してください";
   $isValidated = FALSE;
   }
   elseif (mb_strlen($title, "utf8") > 100) {
   $titleError = "タイトルは100文字以内で入力してください";
   $isValidated = FALSE;
   }

   // 記事のバリデーション
   if ($article === "") {
   $articleError = "記事を入力してください";
   $isValidated = FALSE;
   }
}

// バリデーションで問題が無ければデータベースに登録
if ($isValidated == TRUE) {
  try {
  $stmt = $pdo->query("select name from categories;");
  $categoryList = $stmt->fetchAll(PDO::FETCH_ASSOC);

   // 記事の登録
   $stmt = $pdo->prepare("INSERT INTO articles
   (category_id, title, article, created)VALUES
   (?, ?, ?, NOW())");
   $stmt->execute(array($category, $title, $article));
   }
   catch (PDOException $e) {
   echo $e->getMessage();
   exit;
  }
} else {
$isValidated = FALSE;
$title = "";
$article = "";


}

 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Taro's Blog | 記事の投稿</title>
    <link href="common.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="container">
        <div id="header">
            <h1>記事の投稿</h1>
        </div>
        <div id="postform">
            <p class="right"><a href="index.php">記事の一覧に戻る</a></p>
            <?php if ($isValidated == TRUE): ?>
            <!-- 完了画面のHTML：始まり -->
            <p>以下の内容で記事を保存しました。</p>
            <table>
                <tr>
                    <th>カテゴリ</th>
                    <td>
                        <?php echo $categoryList[$category-1][name]; ?>
                    </td>
                </tr>
                <tr>
                    <th>タイトル</th>
                    <td>
                        <?php echo $title; ?>
                    </td>
                </tr>
                <tr>
                    <th>記事</th>
                    <td>
                        <?php echo $article; ?>
                    </td>
                </tr>
            </table>
            <p><a href="post_article.php">続けて投稿する</a></p>
            <!-- 完了画面のHTML：終わり -->
            <?php else: ?>
            <!-- フォーム画面のHTML：始まり -->
            <p>記事を入力し、送信ボタンを押してください。</p>
            <form action="" method="post">
                <table>
                    <tr>
                        <th>カテゴリ</th>
                        <td>
                            <select name="category">
                                <?php for($i = 0; $i < 10; $i++): ?>
                                <option <?php if (($i+1) == $category) echo "selected"; ?> value="<?php echo $i; ?>">
                                    <?php echo $categoryList[$i][name];  ?>
                                </option>
                                <?php endfor; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>タイトル</th>
                        <td>
                            <?php if(isset($titleError)): ?>
                            <p class="error">
                                <?php echo $titleError; ?>
                            </p>
                            <?php endif; ?>
                            <input type="text" name="title" size="60" value="" />
                        </td>
                    </tr>
                    <tr>
                        <th>記事</th>
                        <td>
                            <?php if(isset($articleError)): ?>
                            <p class="error">
                                <?php echo $articleError; ?>
                            </p>
                            <?php endif; ?>
                            <textarea name="article" cols="60" rows="5"></textarea>
                        </td>
                    </tr>
                </table>
                <p><input type="submit" value="送信" /></p>
            </form>
            <!-- フォーム画面のHTML：終わり -->
            <?php endif; ?>
        </div>
    </div>
</body>

</html>