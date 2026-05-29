<?php

$conn = new mysqli("127.0.0.1", "root", "root", "auth_db", 3308);


if ($conn->connect_error) {
    die(json_encode([
        "status" => "error",
        "message" => "Auth_DB Connection failed"
    ]));
}
