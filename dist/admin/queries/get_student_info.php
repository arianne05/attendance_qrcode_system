<?php
session_start();
include '../../connection/db_conn.php';

if (isset($_GET['studentID'])) {
    $studentID = $_GET['studentID'];

    $stmt = $pdo->prepare("SELECT * FROM student WHERE studentID = :studentID");
    $stmt->bindParam(':studentID', $studentID, PDO::PARAM_INT);
    $stmt->execute();
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($student) {
        echo json_encode($student);
    } else {
        echo json_encode(['error' => 'Teacher not found.']);
    }
} else {
    echo json_encode(['error' => 'Invalid request.']);
}
?>
