#!/bin/bash

# Check if a variable name is provided
if [ -z "$1" ]; then
    echo "Usage: $0 {variable_name}"
    exit 1
fi

VARIABLE_NAME=$1

# Generate Livewire components
php artisan make:livewire ${VARIABLE_NAME}/Index
php artisan make:livewire ${VARIABLE_NAME}/Create
php artisan make:livewire ${VARIABLE_NAME}/Edit

# Create the Blade file
BLADE_FILE_PATH="resources/views/livewire/${VARIABLE_NAME}/form.blade.php"
mkdir -p "resources/views/livewire/${VARIABLE_NAME}"
touch "$BLADE_FILE_PATH"

echo "Livewire components and Blade file for '${VARIABLE_NAME}' have been generated."
