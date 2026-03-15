# 1. ベースイメージの指定 (PHP 8.3/8.4推奨ですが、composerに合わせ8.2以上を確保)
# Laravel 12 は PHP 8.2+ が必須。PHP 8.2 対応の FrankenPHP イメージ
FROM dunglas/frankenphp:latest-php8.4

# 2. 必要な PHP 拡張機能をインストール
# Neon(PostgreSQL)を使うための pdo_pgsql を含めています。
RUN install-php-extensions \
    pdo_pgsql \
    intl \
    zip \
    bcmath \
    gd \
    opcache

# 3. 環境変数の設定 (Koyebのデフォルトポート 80 に合わせる)
ENV SERVER_NAME=:80
ENV APP_ENV=production
ENV APP_DEBUG=false

# 4. 作業ディレクトリの設定
WORKDIR /app

# 5. プロジェクトファイルのコピー
# .dockerignore で指定したファイル以外がすべてコピーされます。
COPY . .

# 6. Composer のインストール (本番環境用の最適化)
# `--no-dev` で開発用パッケージを除外。autoloadを最適化。
RUN composer install --non-interactive --no-dev --optimize-autoloader

# Laravel のキャッシュ生成（任意）
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache || true

# 7. 権限の設定 (重要)
# サーバーが storage フォルダに書き込めるようにします。
RUN chown -R www-data:www-data storage bootstrap/cache

# 8. エントリポイント設定
# Octaneを使わない場合、FrankenPHPに直接 index.php を処理させます。
ENV FRANKENPHP_CONFIG="worker ./public/index.php"

# Koyeb が渡す $PORT を使って FrankenPHP を起動
CMD ["frankenphp", "run", "--port=${PORT:-8000}", "--workers=4", "--public=/app/public"]
