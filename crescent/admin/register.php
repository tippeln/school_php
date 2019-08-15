<?php
require_once "util.inc.php";
require_once "db.inc.php";
// require_once "auth.inc.php";
// session_start();
// auth_confirm();
 try {
$pdo = db_init();
$sql = "SELECT * FROM admins";
$stmt = $pdo->query($sql);
$idList = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
  catch (PDOException $e) {
    echo $e->getMessage();
    exit;
 }

// var_dump($idList);

if ($_SERVER["REQUEST_METHOD"] === "POST") {

   $isValidated = TRUE;
   // 入力値の取得
   $id = $_POST["id"];
   $pass = $_POST["pass"];

    if ($id === "") {
       $idError = "ログインIDを入力してください。";
       $isValidated = FALSE;
       }
       // タイトルのバリデーション
       if ($pass === "") {
       $passError = "パスワードを入力してください";
       $isValidated = FALSE;
       }
       elseif (!preg_match("/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i",$pass)) {
       $passError = "半角英数8文字以上のパスワードで入力してください。";
       $isValidated = FALSE;
       }
    if ($isValidated == TRUE) {

    try {
       $pdo = db_init();
       $stmt = $pdo->prepare("INSERT INTO admins
       (login_id, login_pass)VALUES
       (?, ?)");
       // INSERT INTO admins(login_id, login_pass) VALUES ('tippeln', SHA2('secrettippeln',256));
       $stmt->execute(array($id, hash("sha256", $pass . $id)));
       $id = "";
       $pass = "";
       header("Location: register.php");
       }
       catch (PDOException $e) {
       echo $e->getMessage();
       exit;
      }
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>アカウント登録 | Crescent Shoes 管理</title>
<link rel="stylesheet" href="css/admin.css">
<style>.comment{font-size: 10px;}</style>
</head>
<body>
<header>
  <div class="inner">
    <span><a href="index.php">Crescent Shoes 管理</a></span>
  </div>
</header>
<div id="container">
  <main>
    <h1>登録</h1>
    <?php if(isset($idError)): ?>
    <p class="error"><?php echo h($idError); ?></p>
    <?php endif; ?>
    <?php if(isset($passError)): ?>
    <p class="error"><?php echo h($passError); ?></p>
    <?php endif; ?>

    <form action="" method="post">
    <table id="loginbox">
      <tr>
        <th>ログインID</th>
        <td><input type="text" name="id" value = <?php echo h($id); ?>></td>
      </tr>
      <tr>
        <th>パスワード</th>
        <td><input type="password" name="pass" value = <?php echo h($pass); ?>><br />
        <span class="comment">※半角英数8文字以上で入力してください</span></td>
      </tr>
    </table>
    <p><input type="submit" value="登録"></p>
    </form>

    <table id="loginbox">


    	<tr>
    		<th>ID</th>
    		<th>ログインID</th>
    	</tr>
      <?php foreach ($idList as $auth): ?>
    	<tr>
    		<td><?php echo h($auth[id]); ?></td>
    		<td><?php echo h($auth[login_id]); ?></td>
    	</tr>
      <?php endforeach; ?>

    </table>
    <p><a href="login.php">ログインページに戻る</a></p>
  </main>
  <footer>
    <p>&copy; Crescent Shoes All rights reserved.</p>
  </footer>
</div>
</body>
</html>