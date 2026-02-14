<?php

session_start();

// セッションにデータがない場合は戻す（直セスサクセス防止）
if (!isset($_SESSION['form'])) {
    header('Location: index.php');
    exit();
}

$post = $_SESSION['form'];
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>お問合せフォーム</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="contact.css">
</head>

<body>

    <div class="confirm-wrapper">
        <h2 class="confirm-title">入力内容の確認</h2>

        <div class="confirm-row">
            <div class="confirm-label">お名前：</div>
            <div class="confirm-value">
                <?= htmlspecialchars($post['name'], ENT_QUOTES, 'UTF-8'); ?>
            </div>
        </div>

        <div class="confirm-row">
            <div class="confirm-label">メールアドレス：</div>
            <div class="confirm-value">
                <?= htmlspecialchars($post['email'], ENT_QUOTES, 'UTF-8'); ?>
            </div>
        </div>

        <div class="confirm-row">
            <div class="confirm-label">お問い合わせ内容：</div>
            <div class="confirm-value">
                <?= nl2br(htmlspecialchars($post['contact'], ENT_QUOTES, 'UTF-8')); ?>
            </div>
        </div>

        <div class="confirm-buttons">
            <form action="thanks.php" method="POST">
                <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
                <button type="submit" class="btn btn-primary">送信する</button>
            </form>

            <form action="index.php" method="POST">
                <input type="hidden" name="back" value="1">
                <button type="submit" class="btn btn-sec">戻る</button>
            </form>
        </div>
    </div>
</body>

</html>