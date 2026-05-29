<?php

$conn = new mysqli(
    "127.0.0.1",
    "root",
    "root",
    "student_db",
    3307
);


if ($conn->connect_error) {
    die(json_encode([
        "status" => "error",
        "message" => "Student_DB Connection failed"
    ]));
}
