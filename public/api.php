<?php 
if (basename($_SERVER['PHP_SELF']) === 'api.php'){
  header("Content-Type: application/json");

  $method = $_SERVER['REQUEST_METHOD'];
  $input = json_decode(file_get_contents('php://input'), true);

  switch ($method){
    case 'GET':
      break;
    case 'POST':
      break;
    case 'PUT':
      break;
    case 'DELETE':
      break;
    default:
      echo json_encode(['message' => 'Invalid request method']);
      break;
  }
  $conn->close();
}

function showFolders($conn){
  $sql = "SELECT students.student_number, 
                   CONCAT(students.l_name, ', ', students.f_name, ' ', students.middle_name) as 'student name', 
                   students.year, students.status
            FROM folder_tracker.students as students
            ORDER BY year, `student name`;";
  
  $result = $conn->query($sql);
  $students = [];

  while ($row = $result->fetch_assoc()){
    $students[] = $row;
  }

  echo json_encode($students);
}

?>