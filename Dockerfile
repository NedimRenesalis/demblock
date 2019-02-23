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

# Provision app
RUN printf '1\nyes\nno' | php init \
    && composer install --no-ansi --no-interaction --no-progress --no-scripts --optimize-autoloader

# Give permissions
RUN chmod 775 /app \
    && chmod 775 /app/*

# Change document root for Apache
RUN mv /app/server/* /etc/apache2/sites-available/ \
    && a2ensite frontend.conf \
    && a2ensite backend.conf \
    && a2dissite 000-default.conf