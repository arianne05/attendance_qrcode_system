<?php
include '../../connection/db_conn.php';

// Remove/Archive
if(isset($_GET['remove'])){
    $attendanceID = $_GET['attendanceID'];
    $status = 'archived';
    $archiveSched = "UPDATE attendance_record SET status=? WHERE attendanceID=?";

    $stmt = $pdo->prepare($archiveSched);
    $stmt->execute([$status, $attendanceID]);

    // Fetch the teacher's first name and accountID using the handleID
    $fetchTeacherQuery = "SELECT * FROM attendance_record 
        INNER JOIN student  ON attendance_record.studentNumber = student.studentNumber
        WHERE attendance_record.attendanceID = :attendanceID";
    $fetchStmt = $pdo->prepare($fetchTeacherQuery);
    $fetchStmt->execute(['attendanceID' => $attendanceID]);

    // Get the first name and accountID from the result
    $student = $fetchStmt->fetch();
    $firstname = $student['firstname'];
    $studentID = $student['studentID'];
    $studentNumber = $student['studentNumber'];

    header("Location: ../profile/student-view.php?header={$firstname}'s Profile&id={$studentID}&studNum={$studentNumber}&removedSchedSuccess");
}


// Edit Student
if(isset($_POST['editStudent'])){
    
    $studentID = $_POST['studentID'];
    $accountID = $_POST['accountID'];
    $studentNumber = $_POST['studentNumber'];

    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];

    $studentBdate = $_POST['studentBdate'];
    $studentGender = $_POST['studentGender'];
    $studentSection = $_POST['studentSection'];
    $studentYear = $_POST['studentYear'];

    

    $updatequery = "UPDATE student 
    SET firstname=?, middlename=?, lastname=?, studentBdate=?, studentGender=?, studentSection=?, 
    studentYear=?, studentNumber=?
    WHERE studentID=?";

    $stmt = $pdo->prepare($updatequery);
    $stmt->execute([$firstname, $middlename, $lastname, $studentBdate, $studentGender, $studentSection, 
    $studentYear, $studentNumber, $studentID]);
    
    // Code for updating attendance records if there are records to update
    if (isset($_POST['attendanceID']) && isset($_POST['qrDate']) && isset($_POST['qrTime']) && isset($_POST['qrSubject'])) {
        $attendanceIDs = $_POST['attendanceID'];
        $qrDates = $_POST['qrDate'];
        $qrTimes = $_POST['qrTime'];
        $qrSubjects = $_POST['qrSubject'];

        for ($i = 0; $i < count($attendanceIDs); $i++) {
            $attendanceID = $attendanceIDs[$i];
            $qrDate = $qrDates[$i];
            $qrTime = $qrTimes[$i];
            $qrSubject = $qrSubjects[$i];

            $updatehandle = "UPDATE attendance_record SET qrDate=?, qrTime=?, qrSubject=? WHERE attendanceID=?";
            $stmt = $pdo->prepare($updatehandle);
            $stmt->execute([$qrDate, $qrTime, $qrSubject, $attendanceID]);
        }
    }

    // for admin recents
    $recentLabel='edited';
    $recentDate = date("Y-m-d");
    $recentTime = date("H:i:s");

    $addrecent = "INSERT INTO recents (accountID, studentNumber, recentDate, recentTime, recentLabel)
    VALUES (?,?,?,?,?)";
    $stmt = $pdo->prepare($addrecent);
    $stmt->execute([$accountID, $studentNumber, $recentDate, $recentTime, $recentLabel]);
    header("Location: ../registration.php?header=Registration&updateStudentSuccess");
}


//Removed student registered account
if(isset($_GET['remove']) && isset($_GET['id'])){
    $studentNumber = $_GET['id'];
    $accountID = $_GET['accountID'];
    $status = 'removed';
    $deactquery = "UPDATE student SET status=? WHERE studentNumber=?";

    $stmt = $pdo->prepare($deactquery);
    $stmt->execute([$status, $studentNumber]);

     // for admin recents
     $recentLabel='archived';
     $recentDate = date("Y-m-d");
     $recentTime = date("H:i:s");
 
     $addrecent = "INSERT INTO recents (accountID, studentNumber, recentDate, recentTime, recentLabel)
     VALUES (?,?,?,?,?)";
     $stmt = $pdo->prepare($addrecent);
     $stmt->execute([$accountID, $studentNumber, $recentDate, $recentTime, $recentLabel]);

    header("Location: ../registration.php?header=Student&removedTeacherSuccess");
}

//Restore
if(isset($_GET['restore']) && isset($_GET['id'])){
    $studentID = $_GET['id'];
    $status = '';
    $deactquery = "UPDATE student SET status=? WHERE studentID=?";

    $stmt = $pdo->prepare($deactquery);
    $stmt->execute([$status, $studentID]);
    header("Location: ../registration.php?header=Student&restoreTeacherSuccess");
}

//Removed student attendance
if(isset($_GET['deactivate'])){
    $studentNumber = $_GET['id'];
    $accountID = $_GET['accountID'];
    $status = 'removed';
    $deactquery = "UPDATE student SET status=? WHERE studentNumber=?";

    $stmt = $pdo->prepare($deactquery);
    $stmt->execute([$status, $studentNumber]);

     // for admin recents
     $recentLabel='archived';
     $recentDate = date("Y-m-d");
     $recentTime = date("H:i:s");
 
     $addrecent = "INSERT INTO recents (accountID, studentNumber, recentDate, recentTime, recentLabel)
     VALUES (?,?,?,?,?)";
     $stmt = $pdo->prepare($addrecent);
     $stmt->execute([$accountID, $studentNumber, $recentDate, $recentTime, $recentLabel]);

    header("Location: ../registration.php?header=Student&removedTeacherSuccess");
}

//Scan on submit
if(isset($_POST['text'])){
    $studentNumber=$_POST['text'];
    $accountID= $_POST['accountID'];

    $qrDate = date("Y-m-d");
    // Set the timezone to Asia/Manila (Philippine time)
    date_default_timezone_set('Asia/Manila');
    $qrTime = date("H:i:s");

    $qrSubject = $_POST['qrSubject'];
    $qrSection = $_POST['qrSection'];
    $handleID = $_POST['handleID'];

    $getPath ='accountID='.$accountID.'&qrSubjec='.$qrSubject.'&qrSection='.$qrSection.'&handleID='.$handleID;

    $addquery = "INSERT INTO attendance_record (accountID, studentNumber, qrDate, qrTime, qrSubject, qrSection)
    VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($addquery);
    $stmt->execute([$accountID, $studentNumber, $qrDate, $qrTime, $qrSubject, $qrSection]);

    // Student Name
    $stmt = $pdo->prepare("SELECT * FROM student WHERE studentNumber = :studentNumber");
    $stmt->bindParam(':studentNumber', $studentNumber, PDO::PARAM_INT);
    $stmt->execute();
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
    $studFullname= $student['firstname'].' '.$student['middlename'].' '.$student['lastname'];
    $studSection= $student['studentSection'];
    $studYear= $student['studentYear'];

    header("Location: ../attendance-qr.php?header=Attendance&$getPath&fullname=$studFullname&studSec=$studSection&studYear=$studYear&successAttendance");
  
}
?>