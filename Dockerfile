#start with our base image (the foundation) - version 7.1.5
FROM php:7.3-apache

#install all the system dependencies and enable PHP modules
RUN apt-get update && apt-get install -y \
      libicu-dev \
      libpq-dev \
      libmcrypt-dev \
      default-mysql-client \
      git \
      zip \
      unzip \
      libfreetype6-dev \
      libjpeg62-turbo-dev \
      libpng-dev \
      zlib1g-dev \
      libicu-dev \
      g++ \
    && rm -r /var/lib/apt/lists/*

RUN docker-php-ext-configure intl  \
        && docker-php-ext-install -j$(nproc) iconv intl pdo pdo_mysql mysqli mbstring \
        && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
        && docker-php-ext-install -j$(nproc) gd \
        && docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd

RUN pecl install mcrypt-1.0.2

#install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

#set our application folder as an environment variable
ENV APP_HOME /var/www/html

#change uid and gid of apache to docker user uid/gid
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

#change the web_root to laravel /var/www/html/public folder
RUN sed -i -e "s/html/html\/webroot/g" /etc/apache2/sites-enabled/000-default.conf

# enable apache module rewrite
RUN a2enmod rewrite

#copy source files and run composer
COPY . $APP_HOME

# install all PHP dependencies
RUN composer install --no-interaction

#change ownership of our applications
RUN chown -R www-data:www-data $APP_HOME/tmp
RUN chown -R www-data:www-data $APP_HOME/logs
