<?php
include '../../connection/db_conn.php';

if(isset($_POST['addTeacher'])){
    $firstname = $_POST['teacherFName'];
    $middlename = $_POST['teacherMName'];
    $lastname = $_POST['teacherLName'];
    $username = $_POST['teacherUName'];
    $password = $_POST['teacherPass'];
    $faculty = $_POST['teacherFaculty'];
    $position = 'teacher';
    $status = 'active';

    $query = "INSERT INTO account_information (firstname, middlename, lastname, username, password, faculty, position, status)
        VALUES (?,?,?,?,?,?,?,?)";

    $stmt = $pdo->prepare($query);
    $stmt->execute([$firstname, $middlename, $lastname, $username, $password, $faculty, $position, $status]);
    header("Location: ../teacher.php?header=Teacher&addTeacherSuccess");
}
?>