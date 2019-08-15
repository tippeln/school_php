<?php
try {
 // データベースへ接続する
 $pdo = new PDO("mysql:host=localhost;dbname=mydb", "sysuser", "secret");
 // エラーモードを例外モードに設定
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 // 文字コードを UTF-8 に設定する
 $pdo->exec("SET NAMES utf8");
 // 全件数の取得
 $sql = "SELECT COUNT(*) AS hits FROM members";
 $stmt = $pdo->query($sql);
 $res = $stmt->fetch();
 $hits = $res["hits"];
 // ページ数の計算
 $numPages = ceil($hits / 3);
 // ページ番号の取得
 if (isset($_GET["p"])) {
 $page = $_GET["p"];
 }
 else {
 $page = 1;
 }
 // LIMIT のオフセット(相殺・差し引きの意味)計算
 $offset = ($page - 1) * 3;
 // 会員リストの取得
 $sql = "SELECT * FROM members LIMIT {$offset},3";
 $stmt = $pdo->query($sql);
 $memberList = $stmt->fetchAll();
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
<p>件数： <?php echo $hits; ?></p>
<p>ページ数： <?php echo $numPages; ?></p>
<p>
<?php for ($i = 1; $i <= $numPages; $i++): ?>
<a href="?p=<?php echo $i; ?>"><?php echo $i; ?></a>
|
<?php endfor; ?>
</p>
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