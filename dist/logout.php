<?php

include './connection/db_conn.php';

// Start the session
session_start();

// Perform the logout action
if (isset($_SESSION['accountID'])) {
    // Clear all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect the user to the login page or any other desired page
    header("Location: index.php");
    exit();
} else {
    // If the user is not logged in, redirect them to the login page (or handle it as per your application's logic)
    header("Location: index.php");
    exit();
}
?>
