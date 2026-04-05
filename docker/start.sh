#!/bin/bash
set -e  # stop on any error

# Cache config for production performance
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force

# Start php-fpm in background
php-fpm -D

# Give php-fpm a moment to start before nginx
sleep 1

# Start nginx in foreground
nginx -g "daemon off;"