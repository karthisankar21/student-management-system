<?php
session_start();

header("Content-Type: application/json");

if (isset($_SESSION['user_id'])) {
    echo json_encode([
        "status" => "success",
        "user" => $_SESSION['user_name'],
        "message" => "User logged in"
    ]);

} else {

    echo json_encode([
        "status" => "error",
        "message" => "User not logged in"
    ]);
}

?>