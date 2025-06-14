<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../db/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'PUT' && isset($_GET['id'])) {
  $id = (int) $_GET['id'];
  $data = json_decode(file_get_contents("php://input"), true);

  if (isset($data['status']) && !empty(trim($data['status']))) {
    $status = trim($data['status']);

    try {
      $conn->begin_transaction();

      $stmt = $conn->prepare("UPDATE students SET status = ? WHERE id = ?");
      if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
      }

      $stmt->bind_param("ii", $status, $id);

      if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
      }

      if ($stmt->affected_rows > 0) {
        $conn->commit();
        echo json_encode(["message" => "Student status updated successfully"]);
      } else {
        $conn->rollback();
        http_response_code(404);
        echo json_encode(["error" => "No student found with ID $id"]);
      }
    } catch (Exception $e) {
      $conn->rollback();
      http_response_code(500);
      echo json_encode(["error" => "Transaction failed: " . $e->getMessage()]);
    }
  } else {
    http_response_code(400);
    echo json_encode(["error" => "Missing or empty 'status' field"]);
  }
}

$conn->close();
