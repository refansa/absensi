#!/bin/sh
set -e

echo "========================================"
echo "  Laravel Application - Production Mode"
echo "  Database: SQLite"
echo "========================================"

# Check and generate APP_KEY if needed
if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "base64:YOUR_APP_KEY_HERE" ]; then
    echo "🔑 APP_KEY not set or is placeholder. Generating new APP_KEY..."
    
    # Generate APP_KEY using Laravel's artisan command
    php artisan key:generate --force --no-interaction
    
    echo "✅ APP_KEY generated successfully!"
    echo "⚠️  IMPORTANT: Copy the .env file from the container to persist this key!"
    echo "    Run: docker cp absensi_app:/var/www/html/.env ./.env.production"
else
    echo "✅ APP_KEY is already set"
fi

# Ensure database file exists
if [ ! -f /var/www/html/database/database.sqlite ]; then
    echo "📁 Creating SQLite database file..."
    touch /var/www/html/database/database.sqlite
    chown www-data:www-data /var/www/html/database/database.sqlite
    chmod 664 /var/www/html/database/database.sqlite
fi

# Run migrations
echo "🔄 Running database migrations..."
php artisan migrate --force --no-interaction

# Optimize for production
echo "⚡ Optimizing application for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Storage link
if [ ! -L /var/www/html/public/storage ]; then
    echo "🔗 Creating storage link..."
    php artisan storage:link
fi

# Set permissions
echo "🔒 Setting permissions..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
chmod 664 /var/www/html/database/database.sqlite

echo "✅ Application ready!"
echo "========================================"

# Start supervisor to manage PHP-FPM and Nginx
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
