#!/bin/bash

# Clear and cache config
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Run migrations if needed (ignore errors for now)
php artisan migrate --force 2>/dev/null || true

# Start server
exec php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
