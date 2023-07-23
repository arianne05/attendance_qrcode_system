<?php
require_once './connection/db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Get the form data
    $position = $_POST["position"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Perform basic validation (you can add more validation as per your requirements)
    if (empty($position) || empty($username) || empty($password)) {
        echo "Please fill in all the fields.";
        exit;
    }

    // Prepare the SQL query based on the selected position
    $query = "";
    switch ($position) {
        case "student":
        case "teacher":
            $query = "SELECT * FROM account_information WHERE position = :position AND username = :username AND password = :password";
            break;
        case "admin":
            $query = "SELECT * FROM account_information WHERE position = :position AND username = :username AND password = :password";
            break;
        default:
            echo "Invalid position selected.";
            exit;
    }

    // Execute the prepared statement
    try {
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":position", $position, PDO::PARAM_STR);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->execute();

        // Check if a matching user is found
        if ($stmt->rowCount() > 0) {
            // User found, do something (e.g., redirect to dashboard)
            header("Location: admin/dashboard.php"); // Replace "dashboard.php" with your actual dashboard page
            exit;
        } else {
            // User not found or invalid credentials
            echo "Invalid credentials. Please try again.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
