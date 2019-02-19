FROM php:7.3-apache
#Install git
RUN apt-get update \
    && apt-get install -y git

RUN apt-get install -y \
        libzip-dev \
        zip \
  && docker-php-ext-configure zip --with-libzip \
  && docker-php-ext-install zip

RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN a2enmod rewrite
#Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=. --filename=composer
RUN mv composer /usr/local/bin/

WORKDIR /demblock/login
COPY . .

RUN printf '1\nyes' | php init
RUN composer install
RUN php yii migrate

EXPOSE 3030
 