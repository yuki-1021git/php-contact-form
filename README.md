# PHP Contact Form

## 📌 Overview

実務を想定して設計した、3画面構成のお問い合わせフォームです。

- 入力画面（index.php）
- 確認画面（confirm.php）
- 完了画面（thanks.php）

セキュリティとUXを意識し、実案件レベルの実装を行いました。

---

## 🚀 Demo

## Demo

メール送信機能を含むため、
不正利用防止の観点からデモ環境にはアクセス制限を設定しています。
閲覧をご希望の際はお知らせください。



---

## 🛠 Architecture


---

## 🔒 Security Implementation

本フォームでは以下の対策を実装しています。

### 1. CSRF対策
- トークン生成（bin2hex + random_bytes）
- POST時に検証

### 2. XSS対策
- 出力時に `htmlspecialchars()` を使用

### 3. メールアドレス検証
- `filter_var()` による形式チェック

### 4. 二重送信防止
- セッション破棄処理
- PRGパターンに近い遷移構造

---

## ✨ UX Improvements

- 入力値の保持（confirm→戻る）
- エラーメッセージ表示
- 2カラム確認画面
- ボタン横並び設計
- 余白と視認性を意識したUI設計

---

## 📧 Mail Handling

- 管理者通知メール
- 自動返信メール
- Reply-Toヘッダー設定
- MIME-Version指定
- UTF-8対応
- SPF/DKIM前提構成

---

## 🧰 Tech Stack

- PHP 8.x
- Bootstrap 4
- Xserver
- Git / GitHub

---

## 📈 Future Improvements

- PHPMailer導入（SMTP化）
- HTMLメール対応
- MVC構造へのリファクタリング
- バリデーションJS対応
- Docker環境構築

---

## 👨‍💻 Author

Yuki  
Web制作 / フロントエンド志向  
