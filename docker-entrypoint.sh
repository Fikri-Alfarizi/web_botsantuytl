#!/bin/bash
set -e

echo "=== Starting Laravel Application ==="

# Create storage directories
mkdir -p storage/framework/{cache/data,sessions,views}
mkdir -p storage/logs
mkdir -p bootstrap/cache
chmod -R 777 storage bootstrap/cache

# IMPORTANT: Delete old SQLite database and create fresh one
echo "Creating fresh SQLite database..."
rm -f database/database.sqlite
touch database/database.sqlite
chmod 777 database/database.sqlite

# Clear all caches
echo "Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Run ALL migrations fresh (since we deleted the db)
echo "Running migrations..."
php artisan migrate --force

echo "=== Starting Server on port ${PORT:-8080} ==="
exec php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
