<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $num = $_POST["num"];
    $size = $_POST["size"];

    if ($_FILES["userfile"]["error"] === UPLOAD_ERR_OK) {

        $tempfile = $_FILES["userfile"]["tmp_name"];
        $name = mb_convert_encoding($_FILES["userfile"]["name"], "cp932", "utf8");

        if (!move_uploaded_file($tempfile, "uploads/" . $name)){

            $message = "アップロードされたファイルはありません。";
        }
    }
    elseif ($_FILES["userfile"]["error"] === UPLOAD_ERR_NO_FILE) {
        // 何もしない
    }
    else {
        $message = "アップロードに失敗しました";
    }
}
else {
    $num = 5;
    $size = 200;
}

$files = glob("uploads/*.png");

$fileNames = str_replace(["uploads/",".png"],"",$files);

function h($string)
{
    return htmlspecialchars($string, ENT_QUOTES);
}
?>
<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>画像ギャラリー</title>
    <style>
        table {
         border: 1px solid #666666;
         border-collapse: collapse;
         width: 600px;
        }
        th {
         border: 1px solid #666666;
         background-color: #dddddd;
         padding: 4px;
        }
        td {
         border: 1px solid #666666;
         padding: 4px;
        }
        .error {
         color: #ff0000;
        }
        figure {
            font-size: 10px;
            text-align: center;
            color: #777;
        }
    </style>
</head>
<body>
    <h1>画像ギャラリー</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <p>横並びの数：
            <?php for ($i = 3;$i <= 8; $i++): ?>
                <input type="radio" name="num" <?php if ($i == $num) echo "checked"; ?> value="<?php echo h($i); ?>"><?php echo h($i); ?>&nbsp;
            <?php endfor; ?>
        </p>
        <p>画像幅サイズ：
            <select name="size">
                <?php for ($i = 50;$i < 300; $i+=50): ?>
                    <option <?php if ($i == $size) echo "selected"; ?> value="<?php echo h($i); ?>"><?php echo h($i); ?></option>
                <?php endfor; ?>
            </select>
        </p>
        <p>ファイル：<input type="file" name="userfile">
            <input type="submit" value="送信"></p>
    </form>
    <?php if (isset($message)): ?>
        <p class="error"><?php echo h($message); ?></p>
    <?php endif; ?>
    <table>
        <tr>
            <th colspan="<?php echo h($num); ?>">画像一覧</th>
        </tr>
        <?php if (count($files) > 0): ?>
            <tr>
            <?php for ($i = 0; $i < count($files); $i++): ?>
                <?php $files[$i] = mb_convert_encoding($files[$i], "utf8", "cp932"); ?>
                <?php if ($i % $num === ($num - 1)): ?>
                        <td>
                            <figure>
                            <img src="<?php echo h($files[$i]); ?>" width="<?php echo h($size); ?>">
                                <figcaption>
                                    <?php echo h($fileNames[$i]); ?></span>
                                </figcaption>
                            </figure>
                        </td></tr><tr>

                <?php else: ?>

                        <td>
                            <figure>
                            <img src="<?php echo h($files[$i]); ?>" width="<?php echo h($size); ?>">
                                <figcaption>
                                    <?php echo h($fileNames[$i]); ?></span>
                                </figcaption>
                            </figure>
                        </td>

                <?php endif; ?>
            <?php endfor; ?>
            </tr>
        <?php else: ?>
            <tr>
                <td>アップロードされたファイルがありません。</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>