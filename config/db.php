<?php

$conn = new mysqli(
    "localhost",
    "root",
    "root",
    "student_db"
);

if ($conn->connect_error) {
    die(json_encode([
        "status" => "error",
        "message" => "DB Connection failed"
    ]));
}
