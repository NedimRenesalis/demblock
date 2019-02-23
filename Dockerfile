FROM yiisoftware/yii2-php:7.2-apache

# Install Composer && Assets Plugin
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=. --filename=composer \
    && mv composer /usr/local/bin/ \
    && rm -rf /var/cache/apk/* 

# Get composer fixes
RUN composer global require "fxp/composer-asset-plugin:dev-master"

WORKDIR /app
COPY . .

# Set environmental variables
ENV MYSQL_DATABASE=${MYSQL_DATABASE}
ENV MYSQL_USER=${MYSQL_USER}
ENV MYSQL_PASSWORD=${MYSQL_PASSWORD}

# Give permissions
RUN chmod 777 /app && \
    chmod 777 /app/* && \
    chown www-data:www-data /run/apache2/ && \
    chmod 777 /run/apache2/

# Install Composer dependencies
RUN composer install --no-ansi --no-interaction --no-scripts --no-progress --optimize-autoloader
RUN printf '1\nyes\nall' | php init

# Change document root for Apache
RUN mv /app/server/* /etc/apache2/sites-available/ \
    && a2ensite frontend.conf \
    && a2ensite backend.conf \
    && a2dissite 000-default.conf