<?php
 include '../../connection/db_conn.php';

$date_from = $_GET['date_from'];
$date_to = $_GET['date_to'];
$accountID = $_GET['accountID'];

if (!empty($date_from) && empty($date_to)) {
    // Fetch login_act table and student table
    $stmt = $pdo->prepare("SELECT * FROM teacher_handle WHERE accountID='$accountID'");
    $stmt->execute();
    $fetchSection = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
}

if (!empty($date_from) && !empty($date_to)) { //WHEN BOTH DATE IS SELECTED
   // Fetch login_act table and student table
   $stmt = $pdo->prepare("SELECT * FROM teacher_handle WHERE accountID='$accountID'");
   $stmt->execute();
   $fetchSection = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
}

if (empty($date_from) && empty($date_to)) { //WHEN BOTH DATE IS EMPTY
    // Fetch login_act table and student table
    $stmt = $pdo->prepare("SELECT * FROM teacher_handle WHERE accountID='$accountID'");
    $stmt->execute();
    $fetchSection = $stmt->fetchAll(PDO::FETCH_ASSOC);

}

// CSV data
$csv_data = "Section,School Year,Present Student,Subject,Schedule\n"; // CSV header

foreach ($fetchSection as $section) {
    $subject=$section['subject'];
    $Getsection=$section['section'];
    if (!empty($date_from) && empty($date_to)) {
        $total_per_section = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM attendance_record WHERE qrSubject='$subject' AND qrSection='$Getsection' AND accountID='$accountID' AND qrDate='$date_from'")->fetchColumn();
    } 
    if (!empty($date_from) && !empty($date_to)){
        $total_per_section = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM attendance_record WHERE qrSubject='$subject' AND qrSection='$Getsection' AND accountID='$accountID' AND qrDate>='$date_from' AND qrDate<='$date_to'")->fetchColumn();
    }
    if (empty($date_from) && empty($date_to)){
        $total_per_section = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM attendance_record WHERE qrSubject='$subject' AND qrSection='$Getsection' AND accountID='$accountID'")->fetchColumn();
    }
   
    $csv_data .= "{$section['section']},{$section['schoolYear']},{$total_per_section}, {$section['subject']}, {$section['schedule']}\n";
    
}

// Set headers to force download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="section-handle.csv"');

// Output CSV data
echo $csv_data;
exit;
?>
