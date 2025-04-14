<?php
session_start();



require '../validation.php';

$errors = validation($_POST);
$esc = array_map('hsc', $_POST); // ここで初期化

$pageFlag = 0;

if (isset($_POST['confirm__submit']) && empty($errors)) {
  $pageFlag = 1;
}

if (isset($_POST['form__submit'])) {
  $pageFlag = 2;
}

function hsc($str)
{
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../style.css" />
  <title>株式会社ベース</title>
</head>

<body>
  <section class="fv__contact--container">
    <div class="fv__box contact">
      <header id="header">
        <h1><a href="/">株式会社ベース</a></h1>
        <div class="openbtn"><span></span><span>Menu</span><span></span></div>
        <nav class="header__nav">
          <ul>
            <li><a href="/">Home</a></li>
            <li><a href="../#about">About us</a></li>
            <li class="about-link">
              <a href="#">Service</a>
              <div class="dropDown">
                <ul>
                  <li class="dropDown__link"><a href="../service_callcenter">コールセンター事業</a></li>
                  <li class="dropDown__link"><a href="../service_alliance">アライアンス事業</a></li>
                  <li class="dropDown__link"><a href="../service_bpo">BPO事業</a></li>
                </ul>
              </div>
              <div class="dropDown__sp-only">
                <a href="../service_callcenter">コールセンター事業</a>
                <a href="../service_alliance">アライアンス事業</a>
                <a href="../service_bpo">BPO事業</a>
              </div>
            </li>
            <li class="hamburger__contact"><a href="#">Contact</a></li>
          </ul>
        </nav>
        <div class="hamburger__cover"></div>
      </header>
    </div>
    <div class="contact__top--text">
      <h2>お問い合わせ</h2>
    </div>
  </section>
  <section class="contact__form__container">

    <!-- 入力画面 -->


    <?php if ($pageFlag === 0): ?>

      <p class="contact__form--text area2">フォームにお問い合わせ内容を入力してください。<br>
        <span>※「contact@base.ne.jp」からのメールを受信できるように設定をお願いいたします。</span>
      </p>

      <?php
      if (!isset($_SESSION['csrfToken'])) {
        $csrfToken = bin2hex(random_bytes(32));
        $_SESSION['csrfToken'] = $csrfToken;
      }
      $token = $_SESSION['csrfToken'];
      ?>

      <form method="POST" action="index.php">

        <?php if (!empty($errors) && isset($_POST['confirm__submit'])): ?>
          <?php echo '<ul class="validation__message" >'; ?>
          <?php
          foreach ($errors as $error) {
            echo '<li>' . $error . '</li>';
          }
          ?>
          <?php echo '</ul>'; ?>
        <?php endif; ?>


        <div class="form_list">
          <p class="form_name" for="field_name">お名前<span class="required">*必須</span></p>
          <input name="name" type="text" placeholder="例）山田花子" required="required" value="<?php if (!empty($_POST['name'])) {
            echo hsc($_POST['name']);
          } ?>" />
        </div>
        <div class="form_list">
          <p class="form_name" for="field_email">メールアドレス<span class="required">*必須</span></p>
          <input name="email" type="email" placeholder="sample@base.ne.jp" required="required" value="<?php if (!empty($_POST['email'])) {
            echo hsc($_POST['email']);
          } ?>" />
        </div>
        <div class="form_list">
          <p class="form_name" for="field_tel">電話番号<span class="required">*必須</span></p>
          <input name="tel" type="tel" placeholder="0678785628" required="required" value="<?php if (!empty($_POST['tel'])) {
            echo hsc($_POST['tel']);
          } ?>" />
        </div>
        <div class="form_list">
          <p class="form_name" for="field_email">お問い合わせ内容<span class="required">*必須</span></p>
          <textarea name="contact" type="text" required="required"><?php if (!empty($_POST['contact'])) {
            echo hsc($_POST['contact']);
          } ?></textarea>
        </div>
        <div class="form_agreement">
          <p class="form_name" for="field_agreement"><input name="checkbox" type="checkbox" <?php if (!empty($_POST['checkbox']) && $_POST['checkbox'] === 'on') {
            echo 'checked';
          } ?> />下記の個人情報保護方針に同意の上、送信ボタンを押してください。</p>
          <div class="privacy__policy--container">
            <p class="privacy__title">「お問い合わせにおける個人情報の取扱いについて」</p>
            <p class="privacy__sub--title">（1）個人情報保護管理者：</p>
            <p class="privacy__sub--title">（2）個人情報の利用目的</p>
            <p class="privacy__text">お問い合わせいただいた内容に関して回答及び対応のため以外に個人情報を利用することはございません。</p>
            <p class="privacy__sub--title">（3）個人情報の第三者提供について</p>
            <p class="privacy__text">取得した個人情報は法令等による場合を除いて第三者に提供することはございません。</p>
            <p class="privacy__sub--title">（4）個人情報の取扱いの委託について</p>
            <p class="privacy__text">
              取得した個人情報の取扱いの全部又は、一部を委託することがあります。<br />
              その場合には、当社において最善の考慮を行います。
            </p>
            <p class="privacy__sub--title">（5）個人情報を与えなかった場合に生じる結果</p>
            <p class="privacy__text">
              個人情報を与えることは任意です。個人情報に関する情報の一部をご提供いただけない場合は、
              お問い合わせ内容に回答できない可能性があります。
            </p>
            <p class="privacy__sub--title">（6）保有個人データの開示等および問い合わせ窓口について</p>
            <p class="privacy__text">
              ご本人からの求めにより、当社が保有する保有個人データに関する開示、利用目的の通知、内容の訂正・追加または削除、
              利用停止、消去、第三者提供の停止および第三者提供記録の開示(以下、開示等という)に応じます。<br />
              開示等に応ずる窓口は、下記の申し出先にご連絡下さい。</p>
            <p class="privacy__text">〒542-0082 大阪府大阪市中央区島之内一丁目22番22号 第一住建島之内堺筋ビル503号<br />
              株式会社ベース 個人情報取り扱い窓口<br />
              <a class="privacy__box--tel">06-7878-5628</a> <br class="sp-only">
              （受付時間：平日 午前11時〜午後18時まで）
            </p>
          </div>
        </div>
        <div class="confirm__submit">
          <button type="submit" name="confirm__submit">確認する</button>
        </div>
        <input type="hidden" name="csrf" value="<?php echo $token; ?>">
      </form>


    <?php endif; ?>

    <!-- 確認画面 -->
    <?php if ($pageFlag === 1): ?>

      <p class="contact__form--text">以下の内容にお間違いがなければ、送信ボタンを押してください。</p>

      <?php if ($_POST['csrf'] === $_SESSION['csrfToken']): ?>

        <form method="POST" action="../complete/">
          <div class="form_list">
            <p class="privacy__sub--title">お名前</p>
            <p class="form__reply"><?php echo hsc($_POST['name']); ?></p>
          </div>
          <div class="form_list">
            <p class="privacy__sub--title">メールアドレス</p>
            <p class="form__reply"><?php echo hsc($_POST['email']); ?></p>
          </div>
          <div class="form_list">
            <p class="privacy__sub--title">電話番号</p>
            <p class="form__reply"><a><?php echo hsc($_POST['tel']); ?></a></p>
          </div>
          <div class="form_list">
            <p class="privacy__sub--title">お問い合わせ内容</p>
            <p class="form__reply"><?php echo hsc($_POST['contact']); ?></p>
          </div>
          <div class="form_agreement">
            <?php if (!empty($_POST['checkbox']) && $_POST['checkbox'] === 'on') {
              echo '個人情報保護方針に同意します';
            } ?>
          </div>
          </div>
          <div class="form__button--box">
            <div class="back__button">
              <button type="submit">戻る</button>
            </div>
            <div class="form__submit">
              <button type="submit" name="form__submit">送信する</button>
            </div>
          </div>

          <input type="hidden" name="name" value="<?php echo $_POST['name']; ?>">
          <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
          <input type="hidden" name="tel" value="<?php echo $_POST['tel']; ?>">
          <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
          <input type="hidden" name="contact" value="<?php echo hsc($_POST['contact']); ?>">
          <input name="checkbox" type="hidden" <?php echo 'checked'; ?> />
          <input type="hidden" name="csrf" value="<?php echo $_SESSION['csrfToken']; ?>">


        </form>
      <?php endif; ?>

    <?php endif; ?>

  </section>
  <footer>
    <p class="js-scroll scroll-top scrollview pc-only"><a href="#about">Scroll</a></p>
    <p class="js-pagetop scroll-top pc-only"><a href="#">Page Top</a></p>
    <div class="footer__container">
      <div>
        <h3><a href="">株式会社ベース</a></h3>
        <div class="footer__tel"><a>TEL：06-7878-5628</a></div>
        <div class="footer__address">
          <p>〒542-0082</p>
          <p>大阪府大阪市中央区島之内一丁目22番22号 第一住建島之内堺筋ビル503号</p>
        </div>
      </div>
      <ul class="footer__nav">
        <li><a href="/">Home</a></li>
        <li><a href="../#about">About us</a></li>
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