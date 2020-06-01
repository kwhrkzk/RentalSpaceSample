FROM php:7.4.5-apache
RUN set -x && \
    apt-get update && \
    apt-get install -y --no-install-recommends wget gnupg git && \
    seq 1 8 | xargs -I{} mkdir -p /usr/share/man/man{} && \
    sh -c 'echo "deb http://apt.postgresql.org/pub/repos/apt/ buster-pgdg main" > /etc/apt/sources.list.d/pgdg.list' && \
    apt-get install -y --no-install-recommends curl ca-certificates && \
    curl https://www.postgresql.org/media/keys/ACCC4CF8.asc | apt-key add - && \
    apt-get update && \
    php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer && \ 
    pear install Pager && \
    apt-get install -y --no-install-recommends libzip-dev zlib1g-dev libonig-dev && \
    apt-get install -y --no-install-recommends libmagick++-dev libmagickwand-dev libpq-dev libfreetype6-dev libjpeg62-turbo-dev libpng-dev libwebp-dev libxpm-dev && \
    printf "\n" | pecl install imagick && \
    apt-get install -y --no-install-recommends postgresql-server-dev-12 zlib1g-dev unzip && \
    docker-php-ext-configure pgsql -with-pgsql=/usr/lib/postgresql/12/pgsql && \
    docker-php-ext-enable imagick && \
    docker-php-ext-install pgsql pdo_pgsql zip xml iconv intl && \
    docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && \
    docker-php-ext-install -j$(nproc) gd && \
    a2enmod rewrite && \
    apt-get -y clean && \
    rm -rf /var/lib/apt/lists/*
CMD ["apache2-foreground"]
