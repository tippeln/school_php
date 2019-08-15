<?php

try {
 // MySQL への接続
 $pdo = new PDO("mysql:host=localhost;dbname=mydb", "sysuser", "secret");
 // エラーモードを例外モードに設定
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 // 文字コードの設定
 $pdo->exec("SET NAMES utf8");
 // 会員のリストを取得
 $stmt = $pdo->query("SELECT * FROM members");
 $memberList = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
 echo $e->getMessage();
 exit;
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>会員管理システム</title>
</head>
<body>
<h1>会員リスト</h1>
<table border="1">
<tr>
 <th>会員 ID</th>
 <th>氏名</th>
 <th>年齢</th>
 <th>住所</th>
 <th>登録日時</th>
</tr>
<?php foreach ($memberList as $member): ?>
<tr>
 <td><?php echo $member["id"]; ?></td>
 <td><?php echo $member["name"]; ?></td>
 <td><?php echo $member["age"]; ?></td>
 <td><?php echo $member["address"]; ?></td>
 <td><?php echo $member["created"]; ?></td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>