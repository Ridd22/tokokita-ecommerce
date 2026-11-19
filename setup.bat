@echo off
cd /d %~dp0
if not exist .env copy .env.example .env
echo Installing PHP dependencies...
composer install
if errorlevel 1 goto error
echo Generating application key...
php artisan key:generate
echo Running database migrations and sample data...
php artisan migrate --seed
if errorlevel 1 goto error
echo Installing JavaScript dependencies...
npm install
if errorlevel 1 goto error
echo.
echo Setup selesai. Jalankan run.bat untuk membuka aplikasi.
pause
exit /b 0
:error
echo.
echo Ada proses yang gagal. Periksa pesan error di atas.
pause
exit /b 1
