#!/bin/sh

if [ ! -f /var/www/.env ]; then
    cp /var/www/.env.example /var/www/.env
    composer install --no-interaction --optimize-autoloader
    php artisan key:generate
    chmod -R 777 /var/www/storage /var/www/bootstrap/cache
fi

php artisan migrate --seed
php artisan test
exec php-fpm
