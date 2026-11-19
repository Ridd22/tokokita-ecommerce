@echo off
cd /d %~dp0
start "TokoKita Laravel" cmd /k "php artisan serve"
start "TokoKita Vite" cmd /k "npm run dev"
start http://127.0.0.1:8000
