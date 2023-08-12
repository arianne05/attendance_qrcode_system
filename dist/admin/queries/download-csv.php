<?php
 include '../../connection/db_conn.php';

$date_from = $_GET['date_from'];
$date_to = $_GET['date_to'];

if (!empty($date_from) && empty($date_to)) {
    // Totals
    $total_prof = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM account_information WHERE position='teacher' AND dateAdded >= '$date_from' AND dateAdded <= '$date_to'")->fetchColumn();
    $total_students = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM student WHERE dateAdded >= '$date_from' AND dateAdded <= '$date_to'")->fetchColumn();
    $total_users = $total_prof + $total_students;

    $student = 'student';

    // Fetch login_act table and student table
    $stmt = $pdo->prepare("SELECT accountID, firstname, middlename, lastname, sex, position, dateAdded FROM account_information WHERE position='teacher' AND dateAdded = '$date_from'
                        UNION ALL
                        SELECT studentNumber, firstname, middlename, lastname, studentGender, :student, dateAdded FROM $student WHERE dateAdded = '$date_from'");
    $stmt->bindParam(':student', $student, PDO::PARAM_STR);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
}

if (!empty($date_from) && !empty($date_to)) { //WHEN BOTH DATE IS SELECTED
    // Totals
    $total_prof = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM account_information WHERE position='teacher' AND dateAdded = '$date_from'")->fetchColumn();
    $total_students = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM student WHERE dateAdded = '$date_from'")->fetchColumn();
    $total_users = $total_prof + $total_students;

    $student = 'student';

    // Fetch login_act table and student table
    $stmt = $pdo->prepare("SELECT accountID, firstname, middlename, lastname, sex, position, dateAdded FROM account_information WHERE position='teacher' AND dateAdded >= '$date_from' AND dateAdded <= '$date_to'
                        UNION ALL
                        SELECT studentNumber, firstname, middlename, lastname, studentGender, :student, dateAdded FROM $student WHERE dateAdded >= '$date_from' AND dateAdded <= '$date_to'");
    $stmt->bindParam(':student', $student, PDO::PARAM_STR);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
}

if (empty($date_from) && empty($date_to)) { //WHEN BOTH DATE IS EMPTY
// Totals
$total_prof = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM account_information WHERE position='teacher'")->fetchColumn();
$total_students = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM student")->fetchColumn();
$total_users = $total_prof + $total_students;

$student = 'student';

// Fetch login_act table and student table
$stmt = $pdo->prepare("SELECT accountID, firstname, middlename, lastname, sex, position, dateAdded FROM account_information WHERE position='teacher'
                        UNION ALL
                        SELECT studentNumber, firstname, middlename, lastname, studentGender, :student, dateAdded FROM $student");
$stmt->bindParam(':student', $student, PDO::PARAM_STR);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

}

// CSV data
$csv_data = "ID Number,Name,Sex,Position,Date Added\n"; // CSV header

foreach ($users as $user) {
    $name = $user['firstname'] . ' ' . $user['middlename'] . ' ' . $user['lastname'];
    $csv_data .= "{$user['accountID']},{$name},{$user['sex']},{$user['position']},{$user['dateAdded']}\n";
}

// Set headers to force download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="users.csv"');

// Output CSV data
echo $csv_data;
exit;
?>
