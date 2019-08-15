 <?php
//セッションを完全に破棄する
// session_start();
// $_SESSION = array();
// $params = session_get_cookie_params();
// setcookie(session_name(), "", time() - 36000,
//  $params["path"], $params["domain"],
//  $params["secure"], $params["httponly"]);
// session_destroy();
require_once "util.inc.php";
del_session();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログアウト</title>
</head>
<body>
    <p>ログアウトしました。</p>
    <p><a href="login.php">ログインページへ</a></p>
</body>
</html>