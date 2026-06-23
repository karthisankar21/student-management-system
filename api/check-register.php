<?php
header("Content-Type: application/json");

include "../config/auth_db.php";

$data = json_decode(file_get_contents("php://input"), true);
$email = $data['email'] ?? '';

$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode([
        "status" => "exists"
    ]);
} else {
    echo json_encode([
        "status" => "not_exists"
    ]);
}
?>