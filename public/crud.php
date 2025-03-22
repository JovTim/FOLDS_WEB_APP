<?php 

include "connection.php";

class db_con {
  private $conn;

  public function __construct($conn)
  {
    $this->conn = $conn;
  }

  public function fetchdata(){
    $sql = "SELECT students.student_number, 
                   CONCAT(students.l_name, ', ', students.f_name, ' ', students.middle_name) as 'student name', 
                   students.year, students.status
            FROM folder_tracker.students as students
            ORDER BY year, `student name`;";
  
  $result = $this->conn->query($sql);

  return $result;
  }

  public function insert($student_no, $f_name, $m_name, $l_name, $year){
    $sql = "INSERT INTO students(student_number, f_name, middle_name, l_name, year, status)
    VALUES ('$student_no', '$f_name', '$m_name', '$l_name', $year, 1);";

    $result = $this->conn->query($sql);

    return $result;
  }
}

?>