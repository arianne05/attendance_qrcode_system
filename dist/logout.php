<?php

include './connection/db_conn.php';

// Start the session
session_start();

// Perform the logout action
if (isset($_SESSION['accountID'])) {
    $accountID = $_SESSION['accountID']; // Store the accountID before unsetting the session

    // Clear all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    $logLabel = 'log out';
    $logDate = date('Y-m-d');
    $logTime = date('H:i:s');
    
    // Insert login activity into the database
    $addLogin = "INSERT INTO login_activity (accountID, logDate, logTime, logLabel) 
                VALUE (?,?,?,?)";
    $stmt = $pdo->prepare($addLogin);
    $stmt->execute([$accountID, $logDate, $logTime, $logLabel]);
    
    // Redirect the user to the login page or any other desired page
    header("Location: index.php");
    exit();
} else {
    // If the user is not logged in, redirect them to the login page (or handle it as per your application's logic)
    header("Location: index.php");
    exit();
}
?>
