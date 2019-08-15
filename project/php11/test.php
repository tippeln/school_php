<?php

require_once "util.inc.php";

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $isValidated = true; //処理が成功か失敗かのフラグ。初期値は成功
    $name = $_POST[name];
    $kana = $_POST[kana];
    $phone = $_POST[phone];

    // バリデーション（別々の条件文）
    if($name === "") { //!issetだと機能しないので($name === "")
        $nameError = "氏名を入力してください";
        $isValidated = false;
    }
    if($kana === "") {
        $kanaError = "フリガナを入力してください";
        $isValidated = false;
    }elseif(preg_match("/^[ァ-ヶ]+$/u")) {
        $kanaError = "フリガナの形式が正しくありません";
        $isValidated = false;
    }
    if($phone === "") {
        $phoneError = "電話番号を入力してください";
        $isValidated = false;
    }
    elseif((preg_match("/^0¥d{9}$/", $phone)) or (preg_match("/^0¥d{10}$/", $phone))) {
        $phoneError = "電話番号の形式が正しくありません";
        $isValidated = false;
    }
} else { //GETの場合（通常アクセスの初回時）
    $isValidated = false;
    $name = "";
    $kana = "";
    $phone = "";
    $nameError = "";
    $kanaError = "";
    $phoneError = "";
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<style>
table {
 border: 1px solid #666;
 border-collapse: collapse;
 width: 450px;
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
<?php if($isValidated === "true"): ?>
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
<?php endif; ?>


<form action="" method="post">
<table>
 <tr>
 <th>氏名</th>
 <td>
<input type="text" name="name">
<?php if ($nameError != ""): ?>
 <span class="error"><?php echo h($nameError); ?></span>
<?php endif; ?>
 </td>
 </tr>
 <tr>w
 <th>フリガナ</th>
 <td>
<input type="text" name="kana">
<?php if ($kanaError != ""): ?>
 <span class="error"><?php echo h($kanaError); ?></span>
<?php endif; ?>
 </td>
 </tr>
 <tr>
 <th>氏名</th>
 <td>
<input type="text" name="phone">
<?php if ($phoneError != ""): ?>
 <span class="error"><?php echo h($phoneError); ?></span>
<?php endif; ?>
 </td>
 </tr>
</table>
</form>
</body>
</html>