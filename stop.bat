@echo off

echo stopping docker containers...
docker-compose down

taskkill /F /IM "php.exe" 

echo project stopped.

echo stop the cmd terminal.
taskkill /F /IM "cmd.exe"
