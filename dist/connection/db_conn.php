<?php
// Replace these variables with your actual database credentials
$host = 'localhost';
$dbname = 'qr_attendance_system';
$username = 'root';
$password = '';

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Set PDO attributes (optional but recommended)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable error reporting
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // Disable emulated prepared statements for security
} catch (PDOException $e) {
    // If an error occurs, you can handle it here
    // For example, you can log the error or display a user-friendly message
    echo "Connection failed: " . $e->getMessage();
}
?>
