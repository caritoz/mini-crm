FROM php:8.0.3-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpq-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath
#RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/
RUN docker-php-ext-install gd soap opcache

RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer \
    && composer self-update --2

## Install git
RUN apt-get update \
    && apt-get -y install git \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Get latest Node
#COPY --from=node:latest  . .
RUN cd /var/www/html \
        && curl -sL https://deb.nodesource.com/setup_12.x | bash - \
        && apt-get install -y nodejs \
        && curl -L https://www.npmjs.com/install.sh | sh

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

COPY php-entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

#RUN groupadd -r www-data && adduser www-data

#COPY artisan.sh /usr/local/bin
#RUN chmod +x /usr/local/bin/artisan.sh
ONBUILD RUN chmod +x /var/www/html/suite/.env
ONBUILD RUN chmod +x /var/www/html/suite/.env.testing

RUN chown -R www-data:www-data /var/www/html