@echo off

echo Starting Docker containers...
docker compose up --build -d

echo Waiting for services...
timeout /t 20 > nul

start http://localhost:8000/frontend/