FROM php:8.2-apache

# Install extensions
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip \
    && a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . .

# Create .env for build
RUN cp .env.example .env && \
    sed -i 's/APP_KEY=/APP_KEY=base64:eWFfvtGHigQHuIwlM4P2iAaDAPPd3f3wnQIFx31Lj8Q=/' .env && \
    sed -i 's/APP_ENV=local/APP_ENV=production/' .env && \
    sed -i 's/APP_DEBUG=true/APP_DEBUG=false/' .env

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Cache config
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# Set Apache document root to public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Use PORT from Railway
RUN sed -i 's/80/${PORT}/g' /etc/apache2/ports.conf /etc/apache2/sites-available/*.conf

EXPOSE ${PORT}

CMD ["apache2-foreground"]
