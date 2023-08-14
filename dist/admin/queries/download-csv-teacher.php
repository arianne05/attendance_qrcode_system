<?php
 include '../../connection/db_conn.php';

$date_from = $_GET['date_from'];
$date_to = $_GET['date_to'];
if (!empty($date_from) && empty($date_to)) {
    // Totals
    $total_prof = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM account_information WHERE position='teacher' AND dateAdded = '$date_from'")->fetchColumn();

    // Fetch login_act table and student table
    $stmt = $pdo->prepare("SELECT * FROM account_information WHERE position='teacher' AND dateAdded = '$date_from'");
    $stmt->execute();
    $teacherGet = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
}
if (!empty($date_from) && !empty($date_to)) { //WHEN BOTH DATE IS SELECTED
    // Totals
    $total_prof = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM account_information WHERE position='teacher' AND dateAdded >= '$date_from' AND dateAdded <= '$date_to'")->fetchColumn();

    // Fetch login_act table and student table
    $stmt = $pdo->prepare("SELECT * FROM account_information WHERE position='teacher' AND dateAdded >= '$date_from' AND dateAdded <= '$date_to'");
    $stmt->execute();
    $teacherGet = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
}
if (empty($date_from) && empty($date_to)) {
    // Totals
    $total_prof = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM account_information WHERE position='teacher'")->fetchColumn();

    // Fetch login_act table and student table
    $stmt = $pdo->prepare("SELECT * FROM account_information WHERE position='teacher'");
    $stmt->execute();
    $teacherGet = $stmt->fetchAll(PDO::FETCH_ASSOC);

}

// CSV data
$csv_data = "ID Number,Name,Sex,Position,Date Added\n"; // CSV header

foreach ($teacherGet as $teacher) {
    $name = $teacher['firstname'] . ' ' . $teacher['middlename'] . ' ' . $teacher['lastname'];
    $csv_data .= "{$teacher['accountID']},{$name},{$teacher['sex']},{$teacher['position']},{$teacher['dateAdded']}\n";
}

// Set headers to force download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="teachers.csv"');

// Output CSV data
echo $csv_data;
exit;
?>
