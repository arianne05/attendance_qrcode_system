<?php

//SORT DATE
if (isset($_GET['sort_date'])) {
    $date_from = $_GET['date_from'];
    $date_to = $_GET['date_to'];
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
} else { //WHEN THERE ARE NO SELECTED DATE
    // Fetch login_act table and student table
    $stmt = $pdo->prepare("SELECT * FROM teacher_handle WHERE accountID='$accountID'");
    $stmt->execute();
    $fetchSection = $stmt->fetchAll(PDO::FETCH_ASSOC);

}
?>