<?php
header("Content-Type: application/json");

include "../config/auth_db.php";

$data = json_decode(file_get_contents("php://input"), true);

$name = $data['name'] ?? '';
$email = $data['email'] ?? '';
$password = $data['password'] ?? '';

if (empty($name) || empty($email) || empty($password)) {

    echo json_encode([
        "status" => "error",
        "message" => "All fields required"
    ]);
    exit();
}

$hash_password = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare(
    "INSERT INTO users (name, email, password)
     VALUES (?, ?, ?)"
);

$stmt->bind_param("sss", $name, $email, $hash_password);

if ($stmt->execute()) {

    echo json_encode([
        "status" => "success",
        "message" => "User registered successfully"
    ]);

} else {

    echo json_encode([
        "status" => "error",
        "message" => "Registration failed"
    ]);
}