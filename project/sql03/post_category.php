<?php

// フォームが送信された時のみデータを登録する
if ($_SERVER["REQUEST_METHOD"] === "POST") {
   // バリデーションフラグ
   $isValidated = TRUE;
   // 入力値の取得
   $category = $_POST["category"];

   // カテゴリのバリデーション
   if ($category === "") {
   $categoryError = "カテゴリーを入力してください";
   $isValidated = FALSE;
   }
   elseif (mb_strlen($category, "utf8") > 10) {
   $categoryError = "カテゴリーは10文字以内で入力してください";
   $isValidated = FALSE;
   }

   // バリデーションで問題が無ければデータベースに登録
   if ($isValidated == TRUE) {
   try {
   // MySQL への接続
   $pdo = new PDO("mysql:host=localhost;dbname=blog",
  "sysuser", "secret");
   // エラーモードを例外モードに設定
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // 文字コードの設定
   $pdo->exec("SET NAMES utf8");

   // カテゴリー情報の登録
   $stmt = $pdo->prepare("INSERT INTO categories
   (name)VALUES
   (?)");
   $stmt->execute(array($category));
   }
   catch (PDOException $e) {
   echo $e->getMessage();
   exit;
   }

} else {
 $isValidated = FALSE;
}
}

 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Taro's Blog | カテゴリの投稿</title>
    <link href="common.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="container">
        <div id="header">
            <h1>カテゴリの投稿</h1>
        </div>
        <div id="postform">
            <p class="right"><a href="index.php">記事の一覧に戻る</a></p>
            <?php if ($isValidated == TRUE): ?>
            <!-- 完了画面のHTML：始まり -->
            <p>以下の内容でカテゴリを保存しました。</p>
            <table>
                <tr>
                    <th>カテゴリ</th>
                    <td>
                        <?php echo $category; ?>
                    </td>
                </tr>
            </table>
            <p><a href="post_category.php">続けて追加する</a></p>
            <!-- 完了画面のHTML：終わり -->
            <?php else: ?>
            <!-- フォーム画面のHTML：始まり -->
            <p>追加するカテゴリーを入力し、送信ボタンを押してください。</p>
            <form action="" method="post">
                <table>
                    <tr>
                        <th>カテゴリ</th>
                        <td>
                            <?php if(isset($categoryError)): ?>
                            <p class="error">
                                <?php echo $categoryError; ?>
                            </p>
                            <?php endif; ?>
                            <input type="text" name="category" size="60" value="" />
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