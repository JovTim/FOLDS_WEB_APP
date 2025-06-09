<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../db/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'PUT' && isset($_GET['id'])) {
  $id = (int) $_GET['id'];
  $data = json_decode(file_get_contents("php://input"), true);

  if (isset($data['status'])) {
    $status = $conn->real_escape_string($data['status']);

    $sqly = "UPDATE students SET
                status = '$status'
            WHERE id = '$id'";

    if ($conn->query($sqly) === TRUE) {
      if ($conn->affected_rows > 0) {
        echo json_encode(["message" => "Student status updated successfully"]);
      } else {
        http_response_code(404);
        echo json_encode(["error" => "No student found with ID $id"]);
      }
    } else {
      http_response_code(500);
      echo json_encode(["error" => "Database error: " . $conn->error]);
    }
  } else {
    http_response_code(400);
    echo json_encode(["error" => "Missing required fields"]);
  }
}

$conn->close();
