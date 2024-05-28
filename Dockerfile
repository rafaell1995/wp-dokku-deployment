FROM alpine:3.19

RUN apk add --no-cache \
  apache2 \
  curl \
  php82-apache2 \
  php82-bcmath \
  php82-ctype \
  php82-curl \
  php82-dom \
  php82-exif \
  php82-fileinfo \
  php82-ftp \
  php82-gd \
  php82-iconv \
  php82-intl \
  php82-json \
  php82-mbstring \
  php82-mysqli \
  php82-opcache \
  php82-openssl \
  php82-phar \
  php82-pdo \
  php82-pecl-imagick \
  php82-posix \
  php82-simplexml \
  php82-sockets \
  php82-session \
  php82-tokenizer \
  php82-xdebug \
  php82-xmlreader \
  php82-xmlwriter \
  php82-zip

RUN addgroup -S -g 1000 www \
  && adduser -S -D -H -u 1000 -s /sbin/nologin -G www www \
  && chown www:www /run/apache2 /var/www/localhost/htdocs
COPY wordpress.conf /etc/apache2/conf.d/
COPY php-recommended.ini /etc/php82/conf.d/

ENV COMPOSER_ALLOW_SUPERUSER 1
COPY composer.sh .
RUN ./composer.sh \
  && mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/localhost/htdocs

EXPOSE 80

CMD ["httpd", "-DFOREGROUND"]