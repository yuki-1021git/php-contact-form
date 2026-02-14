# PHP Contact Form

## 概要
PHPで実装した3画面構成のお問い合わせフォームです。

- 入力画面（index.php）
- 確認画面（confirm.php）
- 完了画面（thanks.php）

実務を想定し、セキュリティとUXを意識して実装しました。

---

## 実装機能

- バリデーション処理
- XSS対策（htmlspecialchars）
- CSRF対策（トークン生成・検証）
- セッション管理
- 入力値の保持（戻る機能）
- 管理者通知メール
- 自動返信メール
- 迷惑メール対策ヘッダー（Reply-To / MIME / UTF-8）

---

## 使用技術

- PHP 8.x
- Bootstrap 4
- Xserver
- Git / GitHub

---

## セキュリティ対策

- CSRFトークンによる不正送信防止
- filter_varによるメールアドレス検証
- htmlspecialcharsによるXSS対策
- セッション破棄による二重送信防止

---

## 改善予定

- PHPMailerによるSMTP送信対応
- HTMLメール化
- MVC構造へのリファクタリング
