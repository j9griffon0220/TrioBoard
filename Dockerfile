# 26.4現在：Node.jsの記述なし
# Docker内でのビルド（マルチステージビルド方式）はせず、ローカルで npm run build
# 理由：トラブル時のデバッグを考慮（難易度が上がる）、renderの無料枠を意識

# 1. ベースイメージの指定 (PHP 8.3/8.4推奨ですが、composerに合わせ8.2以上を確保)
# Laravel 12 は PHP 8.2+ が必須。PHP 8.2 対応の FrankenPHP イメージ
# FROM dunglas/frankenphp:latest-php8.4
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

# 4. 環境変数の設定
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV APP_LOG=errorlog
# FrankenPHPがリッスンするポート。Renderの $PORT を参照するように設定
ENV SERVER_NAME=:10000

# 5. 作業ディレクトリ
WORKDIR /app

# 6. プロジェクトファイルをコピー
# ローカルでビルドした public/build 等もここで一緒にコピーされる
COPY . .

# 7. Composer を使って Laravel の依存パッケージをインストールする
RUN composer install --no-interaction --no-dev --optimize-autoloader

# 8. 権限設定
# RUN chown -R www-data:www-data storage bootstrap/cache

# Exited with status 126エラー対策
# 実行権限を確実にする（126エラー対策）
# バイナリに「動かしていいよ」という許可を与える
# RUN chmod +x /usr/local/bin/frankenphp

# 9. 起動コマンド (シェルスクリプトを使わず、&& で繋いで実行)
# caddy と直接書くのではなく、frankenphp run を使います
CMD ["frankenphp", "run", "--config", "/etc/caddy/Caddyfile", "--adapter", "caddyfile"]

# 起動時に migrate を実行し、成功したら FrankenPHP を起動する
# CMD ["caddy", "run", "--config", "/etc/caddy/Caddyfile"]
# CMD php artisan migrate --force && \
#     php artisan config:cache && \
#     php artisan route:cache && \
#     php artisan view:cache && \
#     frankenphp run \
#     --config /etc/caddy/Caddyfile \
#     --adapter caddyfile \
#     --port ${PORT:-10000}

    # frankenphp run --config /etc/caddy/Caddyfile --adapter caddyfile --port ${PORT:-10000}
