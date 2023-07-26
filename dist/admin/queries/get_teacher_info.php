<?php
session_start();
include '../../connection/db_conn.php';

if (isset($_GET['accountID'])) {
    $accountID = $_GET['accountID'];

    $stmt = $pdo->prepare("SELECT * FROM account_information WHERE accountID = :accountID AND position = 'teacher'");
    $stmt->bindParam(':accountID', $accountID, PDO::PARAM_INT);
    $stmt->execute();
    $teacher = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($teacher) {
        echo json_encode($teacher);
    } else {
        echo json_encode(['error' => 'Teacher not found.']);
    }
} else {
    echo json_encode(['error' => 'Invalid request.']);
}
?>
