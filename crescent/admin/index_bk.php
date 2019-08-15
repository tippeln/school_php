<?php

require_once "util.inc.php";
require_once "db.inc.php";


define("IMAGE_PATH", "../images/press/");

$pdo = db_init();

$stmt = $pdo->query("select * from news order by posted desc limit 10;");
$itemList = $stmt->fetchAll(PDO::FETCH_ASSOC);




var_dump($itemList);

 ?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>お知らせ一覧 | Crescent Shoes 管理</title>
<link rel="stylesheet" href="css/admin.css">
</head>
<body id="admin_index">
<header>
  <div class="inner">
    <span><a href="index.php">Crescent Shoes 管理</a></span>
    <div id="account">
      admin
      [ <a href="logout.php">ログアウト</a> ]
    </div>
  </div>
</header>
<div id="container">
  <main>
    <h1>お知らせ一覧</h1>
    <p><a href="news_add.php">お知らせの追加</a></p>
    <table>
      <tr>
        <th>日付</th>
        <th>タイトル／お知らせ内容</th>
        <th>画像(64x64)</th>
        <th>編集</th>
        <th>削除</th>
      </tr>
      <?php foreach ($itemList as $item): ?>
      <tr>
        <td class="center"><?php echo $item["posted"]; ?></td>
        <td>
        <span class="title"><?php echo $item["title"]; ?></span>
        <?php echo $item["message"]; ?>
        </td>
        <?php if($item["image"]): ?>
        <td class="center"><img src="<?php echo IMAGE_PATH.$item["image"]; ?>" width="64" height="64" alt=""></td>
        <?php else: ?>
        <td class="center"><img src="<?php echo IMAGE_PATH; ?>press.png" width="64" height="64" alt=""></td>
      <?php endif; ?>
        <td class="center"><a href="news_edit.php?id=<?php echo h($item["id"]) ?>">編集</a></td>
        <td class="center"><a href="news_delete.php?id=<?php echo h($item["id"]) ?>">削除</a></td>
      </tr>
    <?php endforeach; ?>

<!--       <tr>
        <td class="center">2020-04-20</td>
        <td>
        <span class="title">春色がやってきた</span>
        春色のパステルカラー！たくさんの明るい色が店内を飾っています。足元から明るく、お出かけの気分を上げていきましょう！たくさん歩いても大丈夫、ローヒールの靴もたくさん入荷しております。ぜひ店舗にも足をお運びください。
        </td>
        <td class="center"><img src="../images/press/press02.jpg" width="64" height="64" alt=""></td>
        <td class="center"><a href="news_edit.php?id=2">編集</a></td>
        <td class="center"><a href="news_delete.php?id=2">削除</a></td>
      </tr>
      <tr>
        <td class="center">2020-03-01</td>
        <td>
        <span class="title">春の兆しが</span>
        凍えたていた大地にやわらかい日差しがさしてきましたね。そろそろ春の準備です。お散歩にも最適のウォーキングシューズはいかがですか？ウォークラインを考慮した構造で足への負担をやわらげています。ぜひ一度お試しください。
        </td>
        <td class="center"><img src="../images/press/press01.jpg" width="64" height="64" alt=""></td>
        <td class="center"><a href="news_edit.php?id=1">編集</a></td>
        <td class="center"><a href="news_delete.php?id=1">削除</a></td>
      </tr> -->
    </table>
  </main>
  <footer>
    <p>&copy; Crescent Shoes All rights reserved.</p>
  </footer>
</div>
</body>
</html>
