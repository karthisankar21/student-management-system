@echo off

echo starting docker containers...
docker-compose up -d

echo waiting for mysql containers to start...
timeout /t 10

echo starting php server...
start cmd /k php -S localhost:8000

echo waiting for browser to open...
timeout /t 2

echo opening browser...
start http://localhost:8000/frontend/index.html

pause