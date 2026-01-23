#!/bin/bash
# ===========================================
# Production Deployment Script
# Lab Teknik Management System
# ===========================================
# Run this script on your Linux server after uploading files

echo "========================================"
echo "Lab Teknik - Production Deployment"
echo "========================================"

echo ""
echo "[1/7] Installing Composer dependencies..."
composer install --optimize-autoloader --no-dev
if [ $? -ne 0 ]; then
    echo "ERROR: Composer install failed!"
    exit 1
fi

echo ""
echo "[2/7] Setting file permissions..."
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

echo ""
echo "[3/7] Caching configuration..."
php artisan config:cache
if [ $? -ne 0 ]; then
    echo "ERROR: Config cache failed!"
    exit 1
fi

echo ""
echo "[4/7] Caching routes..."
php artisan route:cache
if [ $? -ne 0 ]; then
    echo "ERROR: Route cache failed!"
    exit 1
fi

echo ""
echo "[5/7] Caching views..."
php artisan view:cache
if [ $? -ne 0 ]; then
    echo "ERROR: View cache failed!"
    exit 1
fi

echo ""
echo "[6/7] Running database migrations..."
php artisan migrate --force
if [ $? -ne 0 ]; then
    echo "ERROR: Migration failed!"
    exit 1
fi

echo ""
echo "[7/7] Creating storage link..."
php artisan storage:link

echo ""
echo "========================================"
echo "Deployment Complete!"
echo "========================================"
echo ""
echo "Next steps:"
echo "1. Update .env with your production settings"
echo "2. Set correct file permissions"
echo "3. Configure web server (Apache/Nginx)"
echo "4. Enable HTTPS with Let's Encrypt"
echo ""
