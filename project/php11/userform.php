<?php

require_once "util.inc.php";

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $isValidated = TRUE; //処理が成功か失敗かのフラグ。初期値は成功
    $name = $_POST[name];
    $kana = $_POST[kana];
    $phone = $_POST[phone];

    // バリデーション（別々の条件文）
    if($name === "") { //!issetだと機能しないので($name === "")
        $nameError = "氏名を入力してください";
        $isValidated = FALSE;
    }
    if($kana === "") {
        $kanaError = "フリガナを入力してください";
        $isValidated = FALSE;
    }elseif(!preg_match("/^[ァ-ヶ－ 　]+$/u", $kana)) {
        $kanaError = "フリガナの形式が正しくありません";
        $isValidated = FALSE;
    }
    if($phone === "") {
        $phoneError = "電話番号を入力してください";
        $isValidated = FALSE;
    }
    elseif(!preg_match("/^0\d{9,10}$/", $phone)) {
        $phoneError = "電話番号の形式が正しくありません";
        $isValidated = FALSE;

    }
} else { //GETの場合（通常アクセスの初回時）
    $isValidated = FALSE;
    $name = "";
    $kana = "";
    $phone = "";
    // $nameError = "";
    // $kanaError = "";
    // $phoneError = "";
}
var_dump($phoneError);
var_dump($phone);
var_dump($isValidated);
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<style>
table {
 border: 1px solid #666;
 border-collapse: collapse;
 width: 550px;
}
th {
 border: 1px solid #666;
 background-color: #ddd;
 padding: 4px;
 width: 100px;
}
td {
 border: 1px solid #666;
 padding: 4px;
}
.error {
 font-weight: bold;
 color: #f00;
 font-size: 11px;
}
</style>
</head>
<body>
<h1>ユーザ情報入力</h1>
<?php if($isValidated === TRUE): ?>
<!-- フラグがTRUEの場合：完了画面 -->

<table>
 <tr>
 <th>氏名</th>
 <td><?php echo h($name); ?></td>
 </tr> <tr>
 <th>フリガナ</th>
 <td><?php echo h($kana); ?></td>
 </tr> <tr>
 <th>電話番号</th>
 <td><?php echo h($phone); ?></td>
 </tr>
</table>
<p>入力ありがとうございました。</p>
<p><a href="userform.php">戻る</a></p>
<?php else: ?>
<!-- フラグがFALSEの場合 -->
<p>下のフォームに記入して「送信」ボタンを押してください。</p>



<form action="" method="post">
<table>
 <tr>
 <th>氏名</th>
 <td>
<input type="text" name="name" value="<?php echo h($name); ?>">
<?php if (isset($nameError)): ?>
 <span class="error"><?php echo h($nameError); ?></span>
<?php endif; ?>
 </td>
 </tr>
 <tr>
 <th>フリガナ</th>
 <td>
<input type="text" name="kana" value="<?php echo h($kana); ?>">
<?php if (isset($kanaError)): ?>
 <span class="error"><?php echo h($kanaError); ?></span>
<?php endif; ?>
 </td>
 </tr>
 <tr>
 <th>電話番号</th>
 <td>
<input type="text" name="phone" value="<?php echo h($phone); ?>">
<?php if (isset($phoneError)): ?>
 <span class="error"><?php echo h($phoneError); ?></span>
<?php endif; ?>
 </td>
 </tr>
</table>
<p><input type="submit" value="送信"></p>
</form>
</body>
</html>
<?php endif; ?>