<?php
include './connection/db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve input from the login form
    $input_username = $_POST["username"];
    $input_password = $_POST["password"];

    try {
        // Prepare and execute the login query
        $query = "SELECT * FROM account_information WHERE username = :username";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":username", $input_username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $input_password) {
            // Successful login
            $position = $user['position'];

            // Redirect users to their corresponding dashboards based on their position
            switch ($position) {
                case 'admin':
                    header("Location: admin/dashboard.php?header=Dashboard&loginSuccess");
                    break;
                case 'student':
                    header("Location: student_dashboard.php");
                    break;
                case 'teacher':
                    header("Location: teacher_dashboard.php");
                    break;
                default:
                    // If the position is not recognized, redirect to a generic dashboard
                    header("Location: index.php");
                    break;
            }
            exit();
        } else {
            // Invalid login credentials You can display an error message on the login page
            if(empty($input_username) && empty($input_password)){
                header("Location: index.php?warningLogin1");
                exit();
            } elseif (empty($input_username) && !empty($input_password)){
                header("Location: index.php?warningLogin2");
                exit();
            } elseif (!empty($input_username) && empty($input_password)){
                header("Location: index.php?warningLogin3");
                exit();
            } else{
                header("Location: index.php?warningLogin4");
                exit();
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
