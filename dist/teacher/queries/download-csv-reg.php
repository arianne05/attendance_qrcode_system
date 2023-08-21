<?php
 include '../../connection/db_conn.php';

$date_from = $_GET['date_from'];
$date_to = $_GET['date_to'];
$accountID = $_GET['accountID'];

if (!empty($date_from) && empty($date_to)) {
    // Totals
    $total_register_users = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM student WHERE accountID='$accountID' AND dateAdded = '$date_from'")->fetchColumn();

    // Fetch login_act table and student table
    $stmt = $pdo->prepare("SELECT * FROM student WHERE accountID='$accountID' AND dateAdded = '$date_from'");
    $stmt->execute();
    $fetchStudents = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
}

if (!empty($date_from) && !empty($date_to)) { //WHEN BOTH DATE IS SELECTED
    // Totals
    $total_register_users = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM student WHERE accountID='$accountID' AND dateAdded >= '$date_from' AND dateAdded <= '$date_to'")->fetchColumn();

    // Fetch login_act table and student table
    $stmt = $pdo->prepare("SELECT * FROM student WHERE accountID='$accountID' AND dateAdded >= '$date_from' AND dateAdded <= '$date_to'");
    $stmt->execute();
    $fetchStudents = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
}

if (empty($date_from) && empty($date_to)) { //WHEN BOTH DATE IS EMPTY
    // Totals
    $total_register_users = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM student WHERE accountID='$accountID'")->fetchColumn();

    // Fetch login_act table and student table
    $stmt = $pdo->prepare("SELECT * FROM student WHERE accountID='$accountID'");
    $stmt->execute();
    $fetchStudents = $stmt->fetchAll(PDO::FETCH_ASSOC);

}

// CSV data
$csv_data = "Student Number,Name,Sex,School Year,Date Added\n"; // CSV header

foreach ($fetchStudents as $student) {
    $name = $student['firstname'] . ' ' . $student['middlename'] . ' ' . $student['lastname'];
    $csv_data .= "{$student['studentNumber']},{$name},{$student['studentGender']},{$student['studentYear']},{$student['dateAdded']}\n";
}

// Set headers to force download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="register-student.csv"');

// Output CSV data
echo $csv_data;
exit;
?>
