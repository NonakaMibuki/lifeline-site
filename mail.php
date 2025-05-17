<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// 設置した場所のパスを指定する
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';


// 文字エンコードを指定
mb_language('uni');
mb_internal_encoding('UTF-8');


function sendMail($address, $title, $content)
{
    // インスタンスを生成（true指定で例外を有効化）
    $mail = new PHPMailer(true);

    // 文字エンコードを指定
    $mail->CharSet = 'utf-8';

    try {
        $mail->isSMTP();
        $mail->Host = ''; 
        $mail->SMTPAuth = true;
        $mail->Username = ''; 
        $mail->Password = ''; 
        $mail->SMTPSecure = ''; 
        $mail->Port = 587; 
        $mail->setFrom('contact@', 'ギバー株式会社'); 
        $mail->addAddress($address);
        // 送信内容設定
        $mail->Subject = $title;
        $mail->Body = $content;
        // 送信
        $mail->send();
        return true; // 成功
    } catch (Exception $e) {
        return false; // 失敗
    }
}
