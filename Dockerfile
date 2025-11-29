# Multi-stage build for production Laravel application
FROM node:20-alpine AS node-builder

WORKDIR /app

# Copy package files
COPY package*.json ./

# Install dependencies and build assets
COPY . .
RUN npm ci && npm run build

# PHP Production Image
FROM php:8.4-fpm-alpine

WORKDIR /var/www/html

# Install build dependencies as virtual package
RUN apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        sqlite-dev \
        libpng-dev \
        libjpeg-turbo-dev \
        libwebp-dev \
        freetype-dev \
        libzip-dev \
        oniguruma-dev \
    # Install runtime dependencies and system packages
    && apk add --no-cache \
        nginx \
        supervisor \
        sqlite \
        libpng \
        libjpeg-turbo \
        libwebp \
        freetype \
        libzip \
        oniguruma \
    # Configure and install PHP extensions
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) \
        pdo_sqlite \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        opcache \
    # Cleanup build dependencies
    && apk del .build-deps \
    && rm -rf /var/cache/apk/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . /var/www/html

# Copy built assets from node-builder
COPY --from=node-builder /app/public/build /var/www/html/public/build

# Install PHP dependencies (production only, no dev dependencies)
RUN composer install \
    --no-dev \
    --no-interaction \
    --optimize-autoloader \
    --no-scripts \
    && composer dump-autoload --optimize

# Configure PHP for production
RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini \
    && echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.memory_consumption=128" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.interned_strings_buffer=8" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.max_accelerated_files=10000" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.revalidate_freq=60" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.fast_shutdown=1" >> /usr/local/etc/php/conf.d/opcache.ini

# Copy configuration files
COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh

# Create database directory and set permissions
RUN mkdir -p /var/www/html/database \
    && touch /var/www/html/database/database.sqlite \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache \
    && chmod 664 /var/www/html/database/database.sqlite \
    && chmod +x /usr/local/bin/entrypoint.sh

# Create nginx cache and log directories
RUN mkdir -p /var/cache/nginx /var/log/nginx /run/nginx \
    && chown -R www-data:www-data /var/cache/nginx /var/log/nginx /run/nginx

# Create volume for SQLite database persistence
VOLUME ["/var/www/html/database"]

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
