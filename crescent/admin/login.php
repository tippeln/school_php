<?php

require_once "util.inc.php";
require_once "db.inc.php";
require_once "auth.inc.php";
session_start();
auth_confirm();

$id = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

   $isValidated = TRUE;
   // 入力値の取得
   $id = $_POST["id"];
   $pass = $_POST["pass"];
   $salt = $id;

   if ($id === "") {
   $idError = "ログインIDを入力してください";
   $isValidated = FALSE;
   }

   // お知らせのバリデーション
   if ($pass === "") {
   $passError = "パスワードを入力して下さい";
   $isValidated = FALSE;
   }

   if ($isValidated == TRUE) {

  $pdo = db_init();
  try {
     $stmt = $pdo->prepare("SELECT * FROM admins
     WHERE login_id = (?) and login_pass = (?)");
     $stmt->execute(array($id, hash("sha256", $pass .$salt) ));
     $info = $stmt->fetch(PDO::FETCH_ASSOC);

     if ($info != FALSE) {
     session_start();
     $_SESSION["admin_id"] = $id; //名前を登録して他頁で使用
     $_SESSION["admin_login"] = TRUE; //ログイン成功のフラグ
     header("Location: index.php");
     }
     else {
        $messageError = "ログインIDまたはパスワードに誤りがあります。";
     }
  }
     catch (PDOException $e) {
     echo $e->getMessage();
     exit;
    }
  } else {
   // header("Location: login.php");
  }
}

 ?>



<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ログイン | Crescent Shoes 管理</title>
<link rel="stylesheet" href="css/admin.css">
</head>
<body>
<header>
  <div class="inner">
    <span><a href="index.html">Crescent Shoes 管理</a></span>
  </div>
</header>
<div id="container">
  <main>
    <h1>ログイン</h1>
    <?php if(isset($idError)): ?>
    <p class="error"><?php echo h($idError); ?></p>
  <?php endif; ?>
  <?php if(isset($passError)): ?>
    <p class="error"><?php echo h($passError); ?></p>
  <?php endif; ?>
    <?php if(isset($messageError)): ?>
    <p class="error"><?php echo h($messageError); ?></p>
  <?php endif; ?>
    <form action="" method="post">
    <table id="loginbox">
      <tr>
        <th>ログインID</th>
        <td><input type="text" name="id" value="<?php echo h($id); ?>"></td>
      </tr>
      <tr>
        <th>パスワード</th>
        <td><input type="password" name="pass"></td>
      </tr>
    </table>
    <p><input type="submit" value="ログイン"></p>
    <p>※ログイン ID・パスワードの登録は<a href="register.php">こちら</a></p>
    </form>
  </main>
  <footer>
    <p>&copy; Crescent Shoes All rights reserved.</p>
  </footer>
</div>
</body>
</html>