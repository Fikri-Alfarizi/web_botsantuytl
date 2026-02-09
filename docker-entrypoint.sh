#!/bin/bash
set -e

echo "=== Starting Laravel Application ==="

# Create storage directories
mkdir -p storage/framework/{cache/data,sessions,views}
mkdir -p storage/logs
mkdir -p bootstrap/cache
chmod -R 777 storage bootstrap/cache

# Clear all caches to ensure fresh config
echo "Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Check database connection type
echo "Database connection: ${DB_CONNECTION:-sqlite}"

# Only create SQLite database if using SQLite
if [ "${DB_CONNECTION}" = "sqlite" ] || [ -z "${DB_CONNECTION}" ]; then
    echo "Using SQLite database..."
    mkdir -p database
    touch database/database.sqlite
    chmod 777 database/database.sqlite
else
    echo "Using ${DB_CONNECTION} database at ${DB_HOST}..."
fi

# Run migrations
echo "Running migrations..."
php artisan migrate --force

echo "=== Starting Server on port ${PORT:-8080} ==="
exec php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
