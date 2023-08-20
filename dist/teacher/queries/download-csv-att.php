<?php
 include '../../connection/db_conn.php';

$date_from = $_GET['date_from'];
$date_to = $_GET['date_to'];
$accountID = $_GET['accountID'];

if (!empty($date_from) && empty($date_to)) {
    // Totals
    $total_attendance_student = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM attendance_record WHERE accountID='$accountID' AND qrDate = '$date_from'")->fetchColumn();

    // Fetch login_act table and student table
    $stmt = $pdo->prepare("SELECT * FROM attendance_record WHERE accountID='$accountID' AND qrDate = '$date_from'");
    $stmt->execute();
    $fetchAttendance = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
}

if (!empty($date_from) && !empty($date_to)) { //WHEN BOTH DATE IS SELECTED
    // Totals
    $total_attendance_student = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM attendance_record WHERE accountID='$accountID' AND qrDate >= '$date_from' AND qrDate <= '$date_to'")->fetchColumn();

    // Fetch login_act table and student table
    $stmt = $pdo->prepare("SELECT * FROM attendance_record WHERE accountID='$accountID' AND qrDate >= '$date_from' AND qrDate <= '$date_to'");
    $stmt->execute();
    $fetchAttendance = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
}

if (empty($date_from) && empty($date_to)) { //WHEN BOTH DATE IS EMPTY
    // Totals
    $total_attendance_student = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM attendance_record WHERE accountID='$accountID'")->fetchColumn();

    // Fetch login_act table and student table
    $stmt = $pdo->prepare("SELECT * FROM attendance_record WHERE accountID='$accountID'");
    $stmt->execute();
    $fetchAttendance = $stmt->fetchAll(PDO::FETCH_ASSOC);

}

// CSV data
$csv_data = "Student Number,Name,Sex,Section,Subject,Time-in,Date\n"; // CSV header

foreach ($fetchAttendance as $attendance) {
    $studentNumber=$attendance['studentNumber'];
    // Time Format
    $time = new DateTime($attendance['qrTime']);
    $formattedTime = $time->format('g:i A');

    // Fetch login_act table and student table
    $stmt = $pdo->prepare("SELECT * FROM student WHERE studentNumber='$studentNumber'");
    $stmt->execute();
    $fetchStudent = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($fetchStudent as $student){
    $name = $student['firstname'] . ' ' . $student['middlename'] . ' ' . $student['lastname'];
    $csv_data .= "{$student['studentNumber']},{$name},{$student['studentGender']},{$student['studentSection']}, {$attendance['qrSubject']}, {$formattedTime}, {$attendance['qrDate']}\n";
    }
}

// Set headers to force download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="attendance-student.csv"');

// Output CSV data
echo $csv_data;
exit;
?>
