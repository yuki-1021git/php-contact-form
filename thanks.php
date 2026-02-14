<?php 
session_start();

// セッションがなければ戻す
if (!isset($_SESSION['form'])) {
  header('Location: index.php');
  exit();
}

//CSRFトークン検証
if (
  !isset($_POST['token'], $_SESSION['token']) ||
  $_POST['token'] !== $_SESSION['token']
  ) {
    exit('不正なリクエストです');
  }

$post = $_SESSION['form'];

// 管理者宛てメール
$adminTo = "escape.1021@outlook.com";
$adminSubject = "お問い合わせがありました";

$adminMessage = "お問い合わせ内容\n\n";
$adminMessage .="お名前：" . $post['name'] . "\n";
$adminMessage .= "メール：". $post['email'] . "\n";
$adminMessage .= "内容：\n" .$post['contact'] . "\n";

//自動返信
$userTo = $post['email'];
$userSubject = "お問い合わせありがとうございます";

$userMessage = $post['name'] . "様\n\n";
$userMessage .= "お問い合わせありがとうございます。\n\n";
$userMessage .= "以下の内容で受け付けました。";
$userMessage .= "------------------\n";
$userMessage .= $post['contact']."\n\n";
$userMessage .="担当よりご連絡いたします";

//送信元（サーバー内アドレス）
$headers = "From: contact@john001.jp\r\n";
$headers .= "Reply-To: " .$post['email'] . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

//送信実行
$mailAdmin = mail($adminTo, $adminSubject, $adminMessage, $headers);
$mailUser = mail($userTo, $userSubject, $userMessage, $headers);


//セッション削除(二重送信防止)
unset($_SESSION['form']);
unset($_SESSION['token']);
?>

<!DOCTYPE html>
  <html lang="ja">
    <head>
      <meta charset="UTF-8">
      <title>送信完了</title>
      <link rel="stylesheet" href="contact.css">
    </head>

    <body>
      <div class="container">
        <?php if ($mailAdmin && $mailUser): ?>
          <h2>送信が完了しました</h2>
          <p>お問い合わせありがとうございます。</p>
          <?php endif; ?>
      </div>
    </body>
  </html>
