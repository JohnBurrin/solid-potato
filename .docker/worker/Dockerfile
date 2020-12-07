FROM php:7.4.10-cli

# need gnupg for adding apt repo
RUN apt-get update \
    && apt-get install -y gnupg

# mysql dep for app
RUN docker-php-ext-install -j$(nproc) pdo_mysql
# RUN docker-php-ext-install -j$(nproc) sockets

# required by laravel/horizon
RUN docker-php-ext-install -j $(nproc) pcntl

# required by phpredis cache driver
RUN pecl install redis && docker-php-ext-enable redis

ARG debug

# xdebug for dev
RUN  if [ $debug ]; then \
    pecl install xdebug-2.9.7 \
    && docker-php-ext-enable xdebug; \
fi

RUN ln -sf /usr/share/zoneinfo/Europe/London /etc/localtime \
    && echo "Europe/London" > /etc/timezone \
    && echo 'date.timezone=Europe/London' > /usr/local/etc/php/conf.d/settimezone.ini \
    && echo 'xdebug.profiler_enable_trigger=1' > /usr/local/etc/php/conf.d/xdebugprofiler.ini \
    && echo 'zend_extension=opcache' > /usr/local/etc/php/conf.d/opcache.ini \
    && echo 'opcache.enable=1' >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo 'post_max_size = 15M' > /usr/local/etc/php/conf.d/filesize.ini \
    && echo 'upload_max_filesize = 15M' >> /usr/local/etc/php/conf.d/filesize.ini \
    && echo 'memory_limit = 128M' >> /usr/local/etc/php/conf.d/memory_limit.ini

# grab composer
RUN apt-get update \
    && apt-get install -y git zip unzip
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

WORKDIR /var/www

COPY artisan artisan

# install composer dependencies

COPY composer.json composer.lock ./

RUN if [ $debug ]; then \
    composer install --no-scripts --no-autoloader; \
else \
    composer install --no-scripts --no-autoloader --no-dev; \
fi

COPY html ./html
# copy rest of fileset

COPY bootstrap ./bootstrap
COPY storage ./storage
# fix permissions
RUN chown www-data:www-data -R storage bootstrap

COPY resources ./resources
COPY routes ./routes
COPY database ./database
COPY config ./config
COPY app ./app
COPY phpunit.xml ./phpunit.xml

# generate classmap now extra directories are present
RUN composer dump-autoload --optimize

ARG version

# record version if available
RUN if [ $version ]; then \
    echo $version > VERSION; \
fi

CMD ["php", "artisan", "horizon"]
