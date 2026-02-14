<?php
session_start();

$error = [];
$post = [];

// confirmから戻った場合
if (isset($_POST['back']) && isset($_SESSION['form'])) {
    $post = $_SESSION['form'];
}


//CSRFトークン生成
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

//通常の処理
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['back'])) {
    // CSRFトークン検証
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
        exit('不正なリクエストです');
    }

    $post = $_POST;

    // 名前チェック
    if (($post['name'] ?? '') === '') {
        $error['name'] = 'blank';
    }

    // メールチェック
    if (($post['email'] ?? '') === '') {
        $error['email'] = 'blank';
    } elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
        $error['email'] = 'email';
    }

    // お問い合わせ内容チェック
    if (($post['contact'] ?? '') === '') {
        $error['contact'] = 'blank';
    }

    // エラーが無ければ確認画面へ
    if (count($error) === 0) {
        $_SESSION['form'] = $post;
        header('Location: confirm.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>お問合せフォーム</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="contact.css">
</head>

<body>

    <div class="container">
        <form action="" method="POST" novalidate>
            <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
            <h2 class="form_title">お問い合わせ</h2>

            <!-- 名前 -->
            <div class="form-group">
                <label>お名前 <span style="color:red;">必須</span></label>
                <input type="text" name="name" class="form-control"
                    value="<?= htmlspecialchars($post['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                <?php if (($error['name'] ?? '') === 'blank'): ?>
                    <p class="error_msg">※お名前をご記入下さい</p>
                <?php endif; ?>
            </div>

            <!-- メール -->
            <div class="form-group">
                <label>メールアドレス <span style="color:red;">必須</span></label>
                <input type="email" name="email" class="form-control"
                    value="<?= htmlspecialchars($post['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                <?php if (($error['email'] ?? '') === 'blank'): ?>
                    <p class="error_msg">※メールアドレスをご記入ください</p>
                <?php elseif (($error['email'] ?? '') === 'email'): ?>
                    <p class="error_msg">※メールアドレスを正しくご記入ください</p>
                <?php endif; ?>
            </div>

            <!-- 内容 -->
            <div class="form-group">
                <label>お問い合わせ内容 <span style="color:red;">必須</span></label>
                <textarea name="contact" rows="8" class="form-control"><?=
                                                                        htmlspecialchars($post['contact'] ?? '', ENT_QUOTES, 'UTF-8');
                                                                        ?></textarea>
                <?php if (($error['contact'] ?? '') === 'blank'): ?>
                    <p class="error_msg">※お問い合わせ内容をご記入下さい</p>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary">確認画面へ</button>
        </form>
    </div>

</body>

</html>