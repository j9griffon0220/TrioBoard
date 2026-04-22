# 26.4現在：Node.jsの記述なし
# Docker内でのビルド（マルチステージビルド方式）はせず、ローカルで npm run build
# 理由：トラブル時のデバッグを考慮（難易度が上がる）、renderの無料枠を意識

# 1. ベースイメージの指定 (PHP 8.3/8.4推奨ですが、composerに合わせ8.2以上を確保)
# Laravel 12 は PHP 8.2+ が必須。PHP 8.2 対応の FrankenPHP イメージ
FROM dunglas/frankenphp:1-php8.4

# 2. Dockerの中に Composerそのものを入れる
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 3. PHP拡張のインストール (Neon/PostgreSQL用)
RUN install-php-extensions \
    pdo_pgsql \
    intl \
    zip \
    bcmath \
    opcache


# --- 非rootユーザー設定の追加 ---
# 4. 実行用ユーザー(appuser)を作成
ARG USER=appuser
RUN useradd -m ${USER}

# 5. 【重要】マニュアルに従い、特権ポート用のケーパビリティを削除
# これにより、root以外のユーザーでもエラーなく起動できるようになる
RUN setcap -r /usr/local/bin/frankenphp

# 6. 環境変数の設定
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV APP_LOG=errorlog
# FrankenPHPがリッスンするポート。Renderの $PORT を参照するように設定
ENV SERVER_NAME=:10000

# 7. 作業ディレクトリ
WORKDIR /app

# 8. プロジェクトファイルをコピー
# ローカルでビルドした public/build 等もここで一緒にコピーされる
COPY . .

# 9. 所有権の変更 (ここが重要！)
# /app フォルダと、FrankenPHPが使う設定フォルダの所有者を appuser に変える
RUN chown -R ${USER}:${USER} /app /config/caddy /data/caddy

# 10. Composer を使って Laravel の依存パッケージをインストールする
RUN composer install --no-interaction --no-dev --optimize-autoloader

# 11. 実行ユーザーの切り替え
# これ以降の命令や、アプリの実行は appuser 権限で行われる
USER ${USER}

# 12. 起動コマンド（ENTRYPOINTからCMDに変更）
# 修正後: シェル形式（文字列）で記述し、&& で繋ぐ
CMD php artisan migrate --force --seed && frankenphp run --config /etc/caddy/Caddyfile --adapter caddyfile


