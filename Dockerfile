FROM php:8.2-cli

# Install extensions
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip

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
    sed -i 's/APP_DEBUG=true/APP_DEBUG=true/' .env && \
    sed -i 's|APP_URL=http://localhost|APP_URL=https://news-production-18b9.up.railway.app|' .env && \
    echo "GNEWS_API_KEY=30a516a2514342d3654e14d2c4fde27c" >> .env && \
    echo "GNEWS_BASE_URL=https://gnews.io/api/v4" >> .env && \
    echo "SESSION_DRIVER=file" >> .env && \
    echo "CACHE_STORE=file" >> .env && \
    echo "QUEUE_CONNECTION=sync" >> .env && \
    echo "DB_CONNECTION=sqlite" >> .env

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Set permissions
RUN chmod -R 777 storage bootstrap/cache

# Create log file and database
RUN mkdir -p storage/logs && touch storage/logs/laravel.log && chmod 777 storage/logs/laravel.log
RUN mkdir -p database && touch database/database.sqlite && chmod 777 database/database.sqlite
RUN mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache

CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
