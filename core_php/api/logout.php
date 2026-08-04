<?php
session_start();
header("Content-Type: application/json");

session_unset();
session_destroy();

if (isset($_SESSION['user_id'])) {

    echo json_encode([
        "status" => "error",
        "message" => "Logout failed"
    ]);

} else {
    echo json_encode([
        "status" => "success",
        "message" => "Logged out Successfully"
    ]);
}

?>
