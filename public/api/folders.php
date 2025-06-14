<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../db/conn.php';

// GET FOLDERS
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $sql = "SELECT * FROM students ORDER BY year, l_name, f_name";
  $result = $conn->query($sql);

  if ($result) {
    $students = [];
    while ($row = $result->fetch_assoc()) {
      $students[] = $row;
    }
    echo json_encode($students);
  } else {
    http_response_code(500);
    echo json_encode(["error" => "Query error: " . $conn->error]);
  }
}

// ADD FOLDER
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents("php://input"), true);

  if (
    isset($data['student_number'], $data['f_name'], $data['m_name'], $data['l_name'], $data['year'], $data['status']) &&
    !empty(trim($data['student_number'])) &&
    !empty(trim($data['f_name'])) &&
    !empty(trim($data['l_name'])) &&
    !empty(trim($data['year'])) &&
    !empty(trim($data['status']))
  ) {
    // Sanitize inputs
    $student_no = trim($data['student_number']);
    $f_name = trim($data['f_name']);
    $m_name = trim($data['m_name'] ?? '');
    $l_name = trim($data['l_name']);
    $year = trim($data['year']);
    $status = trim($data['status']);

    try {
      // Begin transaction
      $conn->begin_transaction();

      $stmt = $conn->prepare("INSERT INTO students (student_number, f_name, m_name, l_name, year, status) VALUES (?, ?, ?, ?, ?, ?)");
      if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
      }

      $stmt->bind_param("ssssss", $student_no, $f_name, $m_name, $l_name, $year, $status);

      if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
      }

      // Commit transaction
      $conn->commit();
      http_response_code(201);
      echo json_encode(["message" => "Student Added!"]);
    } catch (Exception $e) {
      $conn->rollback();
      http_response_code(500);
      echo json_encode(["error" => "Transaction failed: " . $e->getMessage()]);
    }
  } else {
    http_response_code(400);
    echo json_encode(["error" => "Missing or empty required fields"]);
  }
}

// UPDATE FOLDER
if ($_SERVER['REQUEST_METHOD'] === 'PUT' && isset($_GET['id'])) {

  $id = (int) $_GET['id'];
  $data = json_decode(file_get_contents("php://input"), true);

  // Validate all required fields
  if (
    isset($data['student_number'], $data['f_name'], $data['m_name'], $data['l_name'], $data['year'], $data['status'], $data['is_enrolled']) &&
    !empty(trim($data['student_number'])) &&
    !empty(trim($data['f_name'])) &&
    !empty(trim($data['l_name'])) &&
    is_numeric($data['is_enrolled'])
  ) {
    $student_no = trim($data['student_number']);
    $f_name = trim($data['f_name']);
    $m_name = trim($data['m_name']);
    $l_name = trim($data['l_name']);
    $year = trim($data['year']);
    $status = trim($data['status']);
    $is_enrolled = (int) $data['is_enrolled'];

    try {
      $conn->begin_transaction();

      $stmt = $conn->prepare("
                UPDATE students SET
                    student_number = ?, 
                    f_name = ?, 
                    m_name = ?, 
                    l_name = ?, 
                    year = ?, 
                    status = ?, 
                    is_enrolled = ?
                WHERE id = ?
            ");

      if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
      }

      $stmt->bind_param("ssssiiii", $student_no, $f_name, $m_name, $l_name, $year, $status, $is_enrolled, $id);

      if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
      }

      if ($stmt->affected_rows > 0) {
        $conn->commit();
        echo json_encode(["message" => "Student updated successfully"]);
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
    echo json_encode(["error" => "Missing or invalid required fields"]);
  }
}

// DELETE FOLDER
if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])) {

  $id = (int) $_GET['id'];

  try {
    $conn->begin_transaction();

    $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
    if (!$stmt) {
      throw new Exception("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $id);

    if (!$stmt->execute()) {
      throw new Exception("Execute failed: " . $stmt->error);
    }

    if ($stmt->affected_rows > 0) {
      $conn->commit();
      echo json_encode(["message" => "Student deleted successfully"]);
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
}

$conn->close();
