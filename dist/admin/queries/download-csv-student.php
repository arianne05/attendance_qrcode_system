<?php
 include '../../connection/db_conn.php';

$date_from = $_GET['date_from'];
$date_to = $_GET['date_to'];

if (!empty($date_from) && empty($date_to)) {
    // Totals
    $total_students = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM student WHERE dateAdded = '$date_from'")->fetchColumn();

    // Fetch login_act table and student table
    $stmt = $pdo->prepare("SELECT * FROM student WHERE dateAdded = '$date_from'");
    $stmt->execute();
    $studentGet = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
}
if (!empty($date_from) && !empty($date_to)) { //WHEN BOTH DATE IS SELECTED
    // Totals
    $total_students = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM student WHERE dateAdded >= '$date_from' AND dateAdded <= '$date_to'")->fetchColumn();

    // Fetch login_act table and student table
    $stmt = $pdo->prepare("SELECT * FROM student WHERE dateAdded >= '$date_from' AND dateAdded <= '$date_to'");
    $stmt->execute();
    $studentGet = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
}
if (empty($date_from) && empty($date_to)) { //WHEN THERE ARE NO SELECTED DATE
    // Totals
    $total_students = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM student")->fetchColumn();

    // Fetch login_act table and student table
    $stmt = $pdo->prepare("SELECT * FROM student");
    $stmt->execute();
    $studentGet = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// CSV data
$csv_data = "Student Number,Name,Sex,Position,Date Added, School Year\n"; // CSV header

foreach ($studentGet as $student) {
    $name = $student['firstname'] . ' ' . $student['middlename'] . ' ' . $student['lastname'];
    $csv_data .= "{$student['accountID']},{$name},{$student['studentGender']},student,{$student['dateAdded']},{$student['studentYear']}\n";
}

// Set headers to force download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="student.csv"');

// Output CSV data
echo $csv_data;
exit;
?>
