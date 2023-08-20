<?php

//SORT DATE
if (isset($_GET['sort_date'])) {
    $date_from = $_GET['date_from'];
    $date_to = $_GET['date_to'];
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
} else { //WHEN THERE ARE NO SELECTED DATE
    // Totals
    $total_attendance_student = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM attendance_record WHERE accountID='$accountID'")->fetchColumn();

    // Fetch login_act table and student table
    $stmt = $pdo->prepare("SELECT * FROM attendance_record WHERE accountID='$accountID'");
    $stmt->execute();
    $fetchAttendance = $stmt->fetchAll(PDO::FETCH_ASSOC);

}
?>