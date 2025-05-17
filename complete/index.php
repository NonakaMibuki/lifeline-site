<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('../mail.php');
require('../validation.php');

$errors = validation($_POST);
$esc = array_map('hsc', $_POST); // ここで初期化

function hsc($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// ここのファイルにフォームの送信データが送られてきたと仮定
$userName = hsc($_POST['name']);
$userEmail = hsc($_POST['email']);
$userTel = hsc($_POST['tel']);
$userContact = hsc($_POST['contact']);

// メール送信フラグ
$sendSuccess = false;

// ユーザー宛メール送信
$address = $userEmail; // フォーム送信者のメールアドレス
$title = "お問い合わせ受付のご確認"; // 件名
$content = <<<EOD
{$userName}様

お問い合わせいただき、誠にありがとうございます。
以下の内容でお問い合わせを承りました。

--------------------------------------
【お名前】  {$userName}
【メール】  {$userEmail}
【電話番号】{$userTel}
【内容】
{$userContact}
--------------------------------------

担当者より3営業日以内にご連絡させていただきます。
万が一、返信が届かない場合は、お手数ですが再度ご連絡いただけますと幸いです。

ギバー株式会社
URL：
電話番号：
所在地：〒102-0083
東京都千代田区麹町3丁目5番地4 麹町インテリジェントビルB-1
EOD;

if (sendMail($address, $title, $content)) {
    $sendSuccess = true;
}

// 管理者宛メール送信
$address = "contact@"; // 管理者のメールアドレス
$title = "お問い合わせがありました"; // 件名
$content = <<<EOD
新しいお問い合わせがありました。

--------------------------------------
【お名前】  {$userName}
【メール】  {$userEmail}
【電話番号】{$userTel}
【内容】
{$userContact}
--------------------------------------

対応をお願いいたします。
EOD;


if (sendMail($address, $title, $content)) {
    $sendSuccess = true;
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="keywords" content="ライフライン, 引越し, 電気, ガス, 新居, 申し込み">
    <link rel="stylesheet" href="../style.css" />
    <title>ギバー株式会社</title>
</head>

<body>
    <section class="fv__container contact">
        <div class="fv__box contact">
            <h1><a href="/">ギバー株式会社</a></h1>
            <h2>Contact</h2>
            <header id="header">
                <div class="openbtn"><span></span><span>Menu</span><span></span></div>
                <nav class="header__nav sub-page">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="../#about">About</a></li>
                        <li>
                            <a href="../#service">Service</a>
                        </li>
                    </ul>
                    <div class="contact__button"><a href="../contact">Contact</a></div>
                </nav>
            </header>
        </div>
    </section>
    <section class="contact__form__container complete">

        <div class="form-steps">
            <div class="step-item">
                <div class="step-circle">1</div>
                <div class="step-label">入力</div>
            </div>
            <div class="step-item">
                <div class="step-circle">2</div>
                <div class="step-label">確認</div>
            </div>
            <div class="step-item current">
                <div class="step-circle">3</div>
                <div class="step-label">完了</div>
            </div>
        </div>

        <?php if ($sendSuccess): ?>
            <p class="success__message">お問い合わせいただき、ありがとうございます。<br>
                3営業日以内に担当よりご連絡させていただきます。<br>
            </p>
            <a href="/" class="top__back--button">> TOPに戻る</a>
        <?php else: ?>
            <p class="error__message">エラーが発生しました。お手数をお掛けいたしますが、もう一度お試しいただけますと幸いです。</p>
            <a href="../contact" class="contact__back--button">> お問い合わせフォームに戻る</a>
        <?php endif; ?>
    </section>
    <footer>
        <div class="footer__container">
            <div>
                <h3><a href="/">ギバー株式会社</a></h3>
                <div class="footer__tel"><a>TEL：00-0000-0000</a></div>
                <div class="footer__address">
                    <p>〒102-0083</p>
                    <p>東京都千代田区麹町3丁目5番地4<br class="sp-only"/>麹町インテリジェントビルB-1</p>
                </div>
            </div>
            <ul class="footer__nav">
                <li><a href="/">Home</a></li>
                <li><a href="../#about">About</a></li>
                <li><a href="../#service">Service</a></li>
                <li><a href="../contact">Contact</a></li>
            </ul>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="../main.js"></script>
</body>

</html>