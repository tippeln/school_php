<?php
// 繰り返す回数を指定
define("NUM",50);

// fakerクラスライブラリの読み込み
require_once '../src/autoload.php';
require_once '../src/Faker/Provider/ja_JP/Title.php';

// Faker静的メソッドでインスタンスを生成
$faker = Faker\Factory::create('ja_JP');

//$faker->name,            // 名前:井上 さゆり
//$faker->postcode,        // 郵便番号:4043535
//$faker->prefecture,      // 都道府県:栃木県
//$faker->city,            // 市:津田市
//$faker->streetAddress,   // 住所:山岸町吉田10-4-5
//$faker->phoneNumber,     // 電話番号:080-2454-2863
//$faker->safeEmail,       // メール:tanabe.taro@example.org
//$faker->dateTimeBetween('-80 years','-20years')->format('Y-m-d'),
// 生年月日 (20〜80年前の誕生日):1987-01-24
//$faker->numberBetween(1, 100), // 1〜100のランダム数字:74
//$faker->realText(20),    // ダミーテキスト20文字:ひとりともだんだろうとしまわって涙なみ。

// // ***** データベース利用実習 *****

// 03.データ操作 練習追加データ(members:6件目から)
for ($i = 6; $i < NUM + 6; $i++) {

    // 半角空きを削除した氏名を取得
    $name = str_replace(" ","",$faker->name);

    // 年齢を取得
    $age = $faker->numberBetween(1, 100);

    // 県名を取得
    $address = $faker->prefecture;

    // 15年前からのランダムな日付を取得
    $date = $faker->dateTimeBetween('-15 years')->format('Y-m-d H:d:s');

    echo "INSERT INTO members (name,age,address,created) VALUES ('".$name."',".$age.",
'".$address."','".$date."');<br>";

}

// 実習課題 02追加データ (categories:3件目から)
// for ($i = 2; $i < 10; $i++) {
//         // カテゴリー名
//         $c_name = CT[$i]["categoryName"];

//         echo "INSERT INTO categories (name) VALUES ('".$c_name."');<br>";
// }

// // 実習課題 02追加データ (categories:5件目から)
// for ($i = 5; $i < NUM + 5; $i++) {

//     // カテゴリーIDを取得
//     $c_id = $faker->numberBetween(1, 10);

//     // タイトルを取得
//     $rand = rand(0,4);
//     $title = CT[$c_id]["categoryTitle"][$rand];

//     // 記事を取得
//     $article = $faker->realText(20);

//     // 15年前からのランダムな日付を取得
//     $date = $faker->dateTimeBetween('-15 years')->format('Y-m-d H:d:s');

//     echo "INSERT INTO articles (category_id,title,article,created) VALUES (".$c_id.",'".$title."','".$article."','".$date."');<br>";

// }


// // 実習課題 04追加データ (posts:4件目から)
// for ($i = 4; $i < NUM + 4; $i++){

//     // 半角空きを削除した氏名を取得
//     $name = str_replace(" ","",$faker->name);

//     // 記事を取得
//     $message = $faker->realText(20);

//     // 1年前からのランダムな日付を取得
//     $date = $faker->dateTimeBetween('-1 years')->format('Y-m-d H:d:s');

//     echo "INSERT INTO posts (name,message,created) VALUES ('".$name."','".$message."','".$date."');<br>";

// }

// // 実習課題 04編集データ (posts:初回3件分の名前変更)
// echo <<<EOT
// UPDATE posts SET name = "田中太郎" where id = 1;<br>
// UPDATE posts SET name = "山田花子" where id = 2;<br>
// UPDATE posts SET name = "佐藤次郎" where id = 3;
// EOT;


// // ***** システム開発実習 *****

// // 実習課題 01-2追加データ (news:7件目から)

// for ($i = 7; $i < 27; $i++){

//     // 1年前からのランダムな日付を取得
//     $posted = $faker->dateTimeBetween('-1 years')->format('Y-m-d H:d:s');

//     // タイトルを取得
//     $rand = rand(0,17);
//     $title = NT[$rand];

//     // 記事を取得
//     $mLength = rand(80,120);
//     $message = $faker->realText($mLength);

//     // 画像ファイル名を取得(画像press06～15.jpgまで追加済の場合)
//     $imgNum = rand(1,15);
//     if ($imgNum < 10) {
//         $image = "press0" . $imgNum  . ".jpg";
//     }else {
//         $image = "press" . $imgNum . ".jpg";
//     }

//     echo "INSERT INTO news (posted,title,message,image) VALUES ('".$posted."','".$title."','".$message."','".$image."');<br>";
// }
?>