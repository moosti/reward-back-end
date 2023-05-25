FROM webdevops/php-nginx:8.2-alpine

ENV WEB_DOCUMENT_ROOT /app/public
ENV PHP_DATE_TIMEZONE "Asia/Tehran"

WORKDIR /app

COPY --chown=application:application ./src .

# RUN composer install --no-interaction

RUN chown -R application:application .
