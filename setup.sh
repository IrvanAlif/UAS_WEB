#!/bin/bash
# =============================================================
# TechNews - Setup Script untuk Shared Hosting / VPS
# Jalankan: bash setup.sh
# =============================================================

echo "=============================="
echo " TechNews Setup Script"
echo "=============================="

# 1. Install dependencies
echo "[1/6] Installing composer dependencies..."
composer install --optimize-autoloader --no-dev

# 2. Copy .env jika belum ada
if [ ! -f .env ]; then
    echo "[2/6] Creating .env file..."
    cp .env.example .env
else
    echo "[2/6] .env already exists, skipping..."
fi

# 3. Generate key
echo "[3/6] Generating application key..."
php artisan key:generate --force

# 4. Migrate & Seed
echo "[4/6] Running database migrations..."
php artisan migrate --force

echo "[4b/6] Running database seeder..."
php artisan db:seed --force

# 5. Storage link
echo "[5/6] Creating storage symlink..."
php artisan storage:link

# 6. Clear & cache config
echo "[6/6] Optimizing..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo ""
echo "=============================="
echo " Setup selesai!"
echo " URL Login Admin: /login"
echo " Email: admin@technews.com"
echo " Password: password"
echo "=============================="
