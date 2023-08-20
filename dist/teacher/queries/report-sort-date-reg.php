<?php

//SORT DATE
if (isset($_GET['sort_date'])) {
    $date_from = $_GET['date_from'];
    $date_to = $_GET['date_to'];
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
} else { //WHEN THERE ARE NO SELECTED DATE
    // Totals
    $total_register_users = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM student WHERE accountID='$accountID'")->fetchColumn();

    // Fetch login_act table and student table
    $stmt = $pdo->prepare("SELECT * FROM student WHERE accountID='$accountID'");
    $stmt->execute();
    $fetchStudents = $stmt->fetchAll(PDO::FETCH_ASSOC);

}
?>