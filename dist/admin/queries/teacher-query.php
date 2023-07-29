<?php
include '../../connection/db_conn.php';

// add Teacher
if(isset($_POST['addTeacher'])){
    $firstname = $_POST['teacherFName'];
    $middlename = $_POST['teacherMName'];
    $lastname = $_POST['teacherLName'];
    $username = $_POST['teacherUName'];
    $password = $_POST['teacherPass'];
    $faculty = $_POST['teacherFaculty'];
    $position = 'teacher';
    $status = 'active';

    $addquery = "INSERT INTO account_information (firstname, middlename, lastname, username, password, faculty, position, status)
        VALUES (?,?,?,?,?,?,?,?)";

    $stmt = $pdo->prepare($addquery);
    $stmt->execute([$firstname, $middlename, $lastname, $username, $password, $faculty, $position, $status]);

    //Get the ID of the teacher for section handle
    $selectquery = $pdo->prepare("SELECT accountID FROM account_information WHERE username = :username");
    $selectquery->bindParam(':username', $username, PDO::PARAM_STR);
    $selectquery->execute();
    $accountID = $selectquery->fetchColumn();

    for ($i = 1; $i <= 10; $i++) {
        $sched[$i] = !empty($_POST['teacherSchedule' . $i]) ? $_POST['teacherSchedule' . $i] : "";
        $section[$i] = !empty($_POST['teacherSection' . $i]) ? $_POST['teacherSection' . $i] : "";
        $subject[$i] = !empty($_POST['teacherSubject' . $i]) ? $_POST['teacherSubject' . $i] : "";
    }

    $addSectionQuery = "INSERT INTO teacher_handle (accountID, sched1, sched2, sched3, sched4, sched5, sched6, sched7, sched8, sched9, sched10,
        section1, section2, section3, section4, section5, section6, section7, section8, section9, section10,
        subject1, subject2, subject3, subject4, subject5, subject6, subject7, subject8, subject9, subject10)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

    $stmt = $pdo->prepare($addSectionQuery);
    $stmt->execute([
        $accountID,
        $sched[1], $sched[2], $sched[3], $sched[4], $sched[5], $sched[6], $sched[7], $sched[8], $sched[9], $sched[10],
        $section[1], $section[2], $section[3], $section[4], $section[5], $section[6], $section[7], $section[8], $section[9], $section[10],
        $subject[1], $subject[2], $subject[3], $subject[4], $subject[5], $subject[6], $subject[7], $subject[8], $subject[9], $subject[10]
    ]);

    header("Location: ../teacher.php?header=Teacher&addTeacherSuccess");
}

// Edit Teacher
if(isset($_POST['editTeacher'])){
    $accountID = $_POST['accountID'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $faculty = $_POST['faculty'];

    $updatequery = "UPDATE account_information 
    SET firstname=?, middlename=?, lastname=?, username=?, password=?,faculty=?
    WHERE accountID=?";

    $stmt = $pdo->prepare($updatequery);
    $stmt->execute([$firstname, $middlename, $lastname, $username, $password, $faculty, $accountID]);
    

    //Update section handle
    for ($i = 1; $i <= 10; $i++) {
        $sched[$i] = !empty($_POST['teacherSchedule' . $i]) ? $_POST['teacherSchedule' . $i] : "";
        $section[$i] = !empty($_POST['teacherSection' . $i]) ? $_POST['teacherSection' . $i] : "";
        $subject[$i] = !empty($_POST['teacherSubject' . $i]) ? $_POST['teacherSubject' . $i] : "";
    }

    $updatehandle = "UPDATE teacher_handle 
    SET sched1=?, sched2=?, sched3=?, sched4=?, sched5=?, sched6=?, sched7=?, sched8=?, sched9=?, sched10=?, 
    section1=?, section2=?, section3=?, section4=?, section5=?, section6=?, section7=?, section8=?, section9=?, section10=?,
    subject1=?, subject2=?, subject3=?, subject4=?, subject5=?, subject6=?, subject7=?, subject8=?, subject9=?, subject10=?
    WHERE accountID=?";

    $stmt = $pdo->prepare($updatehandle);
    $stmt->execute([$sched[1], $sched[2], $sched[3], $sched[4], $sched[5], $sched[6], $sched[7], $sched[8], $sched[9], $sched[10],
    $section[1], $section[2], $section[3], $section[4], $section[5], $section[6], $section[7], $section[8], $section[9], $section[10],
    $subject[1], $subject[2], $subject[3], $subject[4], $subject[5], $subject[6], $subject[7], $subject[8], $subject[9], $subject[10],
    $accountID]);
    header("Location: ../teacher.php?header=Teacher&updateTeacherSuccess");
}

//Deactivate
if(isset($_GET['deactivate']) && isset($_GET['id'])){
    $accountID = $_GET['id'];
    $status = 'inactive';
    $deactquery = "UPDATE account_information SET status=? WHERE accountID=?";

    $stmt = $pdo->prepare($deactquery);
    $stmt->execute([$status, $accountID]);
    header("Location: ../teacher.php?header=Teacher&deactTeacherSuccess");
}
?>