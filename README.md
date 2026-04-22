# Trio Board – Laravel 12 × Livewire × Pest

[**デモサイトを見る (https://trioboard.onrender.com)**](https://trioboard.onrender.com)
※ 現在は Render 上で動作しています。

## 概要 （Overview）

Laravel 12 を用いて構築した掲示板アプリケーションです。
認証・権限制御・リアルタイム投稿反映を含む、モダンな Laravel 構成を意識して実装しています。

## 実装機能（Functional Features）

- Laravel 12 + Starter Kit によるログイン機能
- Role Enum（admin / member / viewer）による権限管理
  - admin：投稿・閲覧（Dashboardあり）
  - member：投稿・閲覧（My pageあり）
  - viewer：閲覧のみ（外部公開用）
- 掲示板（Thread）機能
  - Resource Controller による CRUD 実装
  - Thread / Post のリレーション設計
  - Livewire によるリアルタイム投稿反映・ ページリロードなしの投稿反映
  - バリデーション・例外処理・認可（Gate / Policy）を実装

## 技術的な実装ポイント（Technical Highlights）

- Laravel 12 + Livewire によるリアクティブな掲示板機能の実装
  - ページ遷移なしでの投稿・一覧更新を実現
- 外部公開用に閲覧専用ロール（Viewer）を実装
  - 権限ベースのアクセス制御により、安全な閲覧範囲を制御
- Docker ベースの本番環境を構築（Render）
  - FrankenPHP 環境に対応するため、Dockerfileや起動設定を調整
- Neon（クラウド PostgreSQL）を利用した外部DB連携
  - アプリケーションとDBを分離した構成を採用

### 開発環境

- Docker（Laravel Sail）
- npm （フロントエンドビルド）

### 使用技術 （Tech Stack）

- バックエンド：Laravel 12（PHP 8.2）
- フロントエンド：Vite / TailwindCSS 4 / Livewire 3
- 認証：Laravel Starter Kit（Livewire3）
- テスト：Pest（Feature）

### テスト

- Pest
  - コントローラ・ビジネスロジックのテスト

## 開発環境の起動（Development）

# コンテナ起動

sail up -d

# フロントエンド依存関係

npm install

# 開発ビルド

npm run dev

## 制限事項 （Limitations）

- 閲覧専用ロール（Viewer）はポートフォリオ公開用に限定的に有効化しています
  - 本来はメンバー限定の掲示板であり、一般公開は想定していません（セキュリティ上、公開期間終了後は無効化予定）

## ビルド方法 （Build）

以下のコマンドで本番用ビルドを`dist` フォルダに作成できます：
npm run build

## 今後検討したいこと（Future Considerations）

- MemberマイページにAdmin管理画面への連絡機能を追加

## クレジット / ライセンス（任意）

© Ayako Nakayama 2026 All rights reserved.
このプロジェクトはMITライセンスのもとで公開されています。

このリポジトリは「開発スキルの一例」を示すための参考資料としてご覧いただけると幸いです。
