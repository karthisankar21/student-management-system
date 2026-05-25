<?php 
header("Content-Type: application/json");

include "../config/db.php";

$method = $_SERVER['REQUEST_METHOD'];

/* ---------------- GET STUDENTS ---------------- */
if ($method === "GET") {

    $search = $_GET['search'] ?? '';

    if (!empty($search)) {

        $stmt = $conn->prepare(
            "SELECT * FROM students
             WHERE name LIKE ? OR email LIKE ? OR course LIKE ?"
        );

        $like = "%$search%";

        $stmt->bind_param("sss", $like, $like, $like);

        $stmt->execute();

        $result = $stmt->get_result();

    } else {

        $result = $conn->query("SELECT * FROM students");
    }

    $data = [];

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
}

/* ---------------- ADD STUDENT ---------------- */
elseif ($method === "POST") {

    $data = json_decode(file_get_contents("php://input"), true);

    $name = $data['name'];
    $email = $data['email'];
    $course = $data['course'];

    $stmt = $conn->prepare(
        "INSERT INTO students (name, email, course)
         VALUES (?, ?, ?)"
    );

    $stmt->bind_param("sss", $name, $email, $course);

    $stmt->execute();

    echo json_encode([
        "message" => "Student added"
    ]);
}

/* ---------------- DELETE STUDENT ---------------- */
elseif ($method === "DELETE") {

    $data = json_decode(file_get_contents("php://input"), true);

    $id = $data['id'];

    $stmt = $conn->prepare(
        "DELETE FROM students WHERE id = ?"
    );

    $stmt->bind_param("i", $id);

    $stmt->execute();

    echo json_encode([
        "message" => "Student deleted"
    ]);
}


/* ---------------- EDIT STUDENT ---------------- */
elseif ($method === "PUT") {

    $data = json_decode(file_get_contents("php://input"), true);

    $id = $data['id'];
    $name = $data['name'];
    $email = $data['email'];
    $course = $data['course'];

    $stmt = $conn->prepare(
        "UPDATE students
         SET name=?, email=?, course=?
         WHERE id=?"
    );

    $stmt->bind_param("sssi", $name, $email, $course, $id);

    $stmt->execute();

    echo json_encode([
        "message" => "Student updated"
    ]);
}