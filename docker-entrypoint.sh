#!/bin/sh
set -e

# Install PHP dependencies if vendor dir is missing or empty
if [ ! -d "/var/www/html/vendor" ] || [ -z "$(ls -A /var/www/html/vendor)" ]; then
  composer install --optimize-autoloader --no-dev
fi

# Ensure proper permissions
chown -R www-data:www-data /var/www/html

# Start PHP-FPM
exec php-fpm