<?php
// Qdmailを使ったメール送信
require_once "libs/qd/qdsmtp.php";
require_once "libs/qd/qdmail.php";
// SMTPの設定
$param = array(
 "host" => "w1.sim.zdrv.com", //w1は数字の1
 "port" => 25,
 "from" => "zd3G15@sim.zdrv.com", //formではなくfrom
 "protocol" => "SMTP"
);
// メールの送信
$mail = new Qdmail();
$mail->errorDisplay(FALSE);
$mail->smtpObject()->error_display = FALSE;
$mail->from("zd3G15@sim.zdrv.com", "株式会社〇〇サポート係");
$mail->to("zd3G15@sim.zdrv.com", "三角直美様");
$mail->subject("PHPからメール送信のテスト");
$mail->text("こんにちは！
このメールはPHPのプログラムから送信しています。");
$mail->smtp(TRUE);
$mail->smtpServer($param);
$flag = $mail->send();
if ($flag == TRUE) {
 echo "メールを送信しました。";
}
else {
 echo "メールの送信に失敗しました。";
}
?>