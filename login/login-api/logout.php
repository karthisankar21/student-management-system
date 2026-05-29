<?php
session_start();
session_destroy();

if (isset($_SESSION['user_id'])) {

    echo json_encode([
        "status" => "error",
        "message" => "Logout failed"
    ]);

} else {
    echo json_encode([
        "status" => "success",
        "message" => "Logged out"
    ]);
}

?>
