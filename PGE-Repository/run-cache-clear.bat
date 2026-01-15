@echo off
echo Clearing Laravel cache...
php artisan config:clear
php artisan cache:clear
php artisan config:cache
echo.
echo Cache cleared successfully!
echo.
pause
