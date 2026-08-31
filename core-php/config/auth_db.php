<?php

$host = getenv('DB_HOST') ?: 'auth_db';
$port = getenv('DB_PORT') ?: 3306;

$conn = new mysqli($host, "root", "root", "auth_db", $port);

if ($conn->connect_error) {
    die(json_encode([
        "status" => "error",
        "message" => "Auth_DB Connection failed"
    ]));
}
