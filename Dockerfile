FROM yiisoftware/yii2-php:7.2-apache

# Install Composer && Assets Plugin
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=. --filename=composer \
    && mv composer /usr/local/bin/ \
    && rm -rf /var/cache/apk/* 

WORKDIR /app
COPY . .

# Set environmental variables
ENV MYSQL_DATABASE=${MYSQL_DATABASE}
ENV MYSQL_USER=${MYSQL_USER}
ENV MYSQL_PASSWORD=${MYSQL_PASSWORD}

# Load app
RUN printf '1\nyes\nno' | php init \
    && composer global require "fxp/composer-asset-plugin:dev-master"

# Give permissions
RUN chmod 775 /app \
    && chmod 775 /app/*

# Install Composer dependencies
RUN composer install --no-ansi --no-interaction --no-scripts --no-progress --optimize-autoloader

# Change document root for Apache
RUN mv /app/server/* /etc/apache2/sites-available/ \
    && a2ensite frontend.conf \
    && a2ensite backend.conf \
    rm -rf /etc/apache2/sites-enabled/000-default.conf