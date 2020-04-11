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

# Required environmental variables
# ENV MYSQL_DATABASE=demblock
# ENV MYSQL_USER=
# ENV MYSQL_PASSWORD=
# ENV MYSQL_HOST=

# ENV MAILER_HOST=smtp.gmail.com
# ENV MAILER_PORT=587
# ENV MAILER_USERNAME=support@demblock.com
# ENV MAILER_PASSWORD=

# Give permissions
RUN chmod -R 777 /app && \
    chown www-data:www-data /run/apache2/ && \
    chmod 777 /run/apache2/

# Install Composer dependencies
RUN php init --env=Production --overwrite=All
RUN composer install --no-ansi --no-interaction --no-scripts --no-progress --optimize-autoloader

# Change document root for Apache
RUN mv /app/server/* /etc/apache2/sites-available/ \
    && a2ensite frontend.conf \
    && a2ensite backend.conf \
    && a2dissite 000-default.conf