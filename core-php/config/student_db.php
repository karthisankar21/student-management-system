<?php

$host = getenv('DB_HOST') ?: 'student_db';
$port = getenv('DB_PORT') ?: 3306;

$conn = new mysqli($host, "root", "root", "student_db", $port);


if ($conn->connect_error) {
    die(json_encode([
        "status" => "error",
        "message" => "Student_DB Connection failed"
    ]));
}
