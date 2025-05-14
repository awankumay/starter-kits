#!/bin/bash

# Generate php artisan migrate command
php artisan migrate --force
# Generate php artisan db seed command
php artisan db:seed --force
# Generate php artisan config cache command
php artisan config:cache
# Generate php artisan route cache command
php artisan route:cache
# Generate php artisan view cache command
php artisan view:cache
# Generate php artisan optimize command
php artisan optimize
# Generate php artisan storage link command
php artisan storage:link

