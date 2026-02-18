# Trio Board – Laravel 12 × Livewire × Pest
[**デモサイトを見る**(#) ]（デプロイ準備中・公開後にURLを掲載予定）
※現在はローカル環境で動作確認可能です。

## 概要 （Overview）
Laravel 12 を用いて構築した掲示板アプリケーションです。
認証・権限制御・リアルタイム投稿反映を含む、モダンな Laravel 構成を意識して実装しています。

## 実装機能（Functional Features）
- Laravel 12 + Starter Kit によるログイン機能
- Role Enum（admin / member / viewer）による権限管理
  - admin：投稿・閲覧（Dashboardあり）
  - member：投稿・閲覧（My pageあり）
  - viewer：閲覧のみ（ポートフォリオ公開用）
- 掲示板（Thread）機能
  - Resource Controller による CRUD 実装
  - Thread / Post のリレーション設計
  - Livewire によるリアルタイム投稿反映・ ページリロードなしの投稿反映
  - バリデーション・例外処理・認可（Gate / Policy）を実装

## 技術的な実装ポイント（Technical Highlights）
- 調整中

### 開発環境
- Docker（Laravel Sail）
- npm （フロントエンドビルド）

### 使用技術 （Tech Stack）
- バックエンド：Laravel 12（PHP 8.3）
- フロントエンド：Vite / TailwindCSS 4  / Livewire 4
- 認証：Laravel Starter Kit（Livewire4）
- テスト：Pest（Unit / Feature）

### テスト
- PHPUnit
  - コントローラ・ビジネスロジックのテスト
- Laravel Dusk
  - ブラウザ操作を含むE2Eテスト
- Playwright
  - UI操作・画面遷移の確認（クロスブラウザを意識）

## 開発環境の起動（Development）
# コンテナ起動
sail up -d

# フロントエンド依存関係
npm install

# 開発ビルド
npm run dev

## 制限事項 （Limitations）
検討中

## ビルド方法 （Build）
以下のコマンドで本番用ビルドを`dist` フォルダに作成できます：
npm run build

## 今後検討したいこと（Future Considerations）
- MemberマイページにAdmin管理画面への連絡機能を追加

##  クレジット / ライセンス（任意）
© Ayako Nakayama 2026 All rights reserved.
このプロジェクトはMITライセンスのもとで公開されています。

このリポジトリは「開発スキルの一例」を示すための参考資料としてご覧いただけると幸いです。
