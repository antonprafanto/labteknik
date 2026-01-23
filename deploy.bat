@echo off
REM ===========================================
REM Production Deployment Script
REM Lab Teknik Management System
REM ===========================================
REM Run this script on your server after uploading files

echo ========================================
echo Lab Teknik - Production Deployment
echo ========================================

echo.
echo [1/6] Installing Composer dependencies...
call composer install --optimize-autoloader --no-dev
if %ERRORLEVEL% NEQ 0 (
    echo ERROR: Composer install failed!
    pause
    exit /b 1
)

echo.
echo [2/6] Caching configuration...
php artisan config:cache
if %ERRORLEVEL% NEQ 0 (
    echo ERROR: Config cache failed!
    pause
    exit /b 1
)

echo.
echo [3/6] Caching routes...
php artisan route:cache
if %ERRORLEVEL% NEQ 0 (
    echo ERROR: Route cache failed!
    pause
    exit /b 1
)

echo.
echo [4/6] Caching views...
php artisan view:cache
if %ERRORLEVEL% NEQ 0 (
    echo ERROR: View cache failed!
    pause
    exit /b 1
)

echo.
echo [5/6] Running database migrations...
php artisan migrate --force
if %ERRORLEVEL% NEQ 0 (
    echo ERROR: Migration failed!
    pause
    exit /b 1
)

echo.
echo [6/6] Creating storage link...
php artisan storage:link
if %ERRORLEVEL% NEQ 0 (
    echo WARNING: Storage link may already exist
)

echo.
echo ========================================
echo Deployment Complete!
echo ========================================
echo.
echo Next steps:
echo 1. Update .env with your production settings
echo 2. Set correct file permissions
echo 3. Configure web server (Apache/Nginx)
echo 4. Enable HTTPS
echo.
pause
