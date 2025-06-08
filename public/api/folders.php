<?php
header('Content-Type: application/json');

// Include the database connection
require_once __DIR__ . '/../db/conn.php';

// GET FOLDERS
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $sql = "SELECT * FROM students WHERE is_enrolled = 1";
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

  if (isset($data['student_number'], $data['f_name'], $data['m_name'], $data['l_name'], $data['year'], $data['status'])) {
    $student_no = $conn->real_escape_string($data['student_number']);
    $f_name = $conn->real_escape_string($data['f_name']);
    $m_name = $conn->real_escape_string($data['m_name']);
    $l_name = $conn->real_escape_string($data['l_name']);
    $year = $conn->real_escape_string($data['year']);
    $status = $conn->real_escape_string($data['status']);

    $sql = "INSERT INTO students (student_number, f_name, m_name, l_name, year, status) VALUES ('$student_no', '$f_name', '$m_name', '$l_name', '$year', '$status')";

    if ($conn->query($sql) === TRUE) {
      http_response_code(201);
      echo json_encode(["message" => "Student Added!"]);
    } else {
      http_response_code(500);
      echo json_encode(["error" => "Database error: " . $conn->error]);
    }
  } else {
    http_response_code(400);
    echo json_encode(["error" => "Missing required fields"]);
  }
}

// UPDATE FOLDER
if ($_SERVER['REQUEST_METHOD'] === 'PUT' && isset($_GET['id'])) {
  $id = (int) $_GET['id'];
  $data = json_decode(file_get_contents("php://input"), true);

  // Validate input fields (adjust as needed)
  if (isset($data['student_number'], $data['f_name'], $data['m_name'], $data['l_name'], $data['year'], $data['status'], $data['is_enrolled'])) {
    $student_no = $conn->real_escape_string($data['student_number']);
    $f_name = $conn->real_escape_string($data['f_name']);
    $m_name = $conn->real_escape_string($data['m_name']);
    $l_name = $conn->real_escape_string($data['l_name']);
    $year = $conn->real_escape_string($data['year']);
    $status = $conn->real_escape_string($data['status']);
    $is_enrolled = $conn->real_escape_string($data['is_enrolled']);

    $sql = "UPDATE students SET
                    student_number = '$student_no',
                    f_name = '$f_name',
                    m_name = '$m_name',
                    l_name = '$l_name',
                    year   = '$year',
                    status = '$status',
                    is_enrolled = '$is_enrolled'
                WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
      if ($conn->affected_rows > 0) {
        echo json_encode(["message" => "Student updated successfully"]);
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

// DELETE FOLDER
if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])) {
  $id = (int) $_GET['id'];

  $sql = "DELETE FROM students WHERE id = $id";

  if ($conn->query($sql) === TRUE) {
    if ($conn->affected_rows > 0) {
      echo json_encode(["message" => "Student deleted successfully"]);
    } else {
      http_response_code(404);
      echo json_encode(["error" => "No student found with ID $id"]);
    }
  } else {
    http_response_code(500);
    echo json_encode(["error" => "Database error: " . $conn->error]);
  }
}

$conn->close();
