<?php
    include 'db_conn.php';
    require_once 'phpqrcode/qrlib.php';
    $path = '../qr-images/';
    $qrcode = $path.time().".png";
    $qrImage = time().".png";
    

    if(isset($_POST['generateQR'])){
        $accountID = $_POST['accountID'];
        $firstname = $_POST['firstname'];
        $middlename = $_POST['middlename'];
        $lastname = $_POST['lastname'];
        $studentNumber = $_POST['studentNumber'];
        $studentBdate = $_POST['studentBdate'];
        $studentGender = $_POST['studentGender'];

        // Has a format
        $studentGrade = $_POST['studentGrade'];
        $studentSection = $_POST['studentSection'];
        $studentFinalSection = $studentGrade.'-'.$studentSection;

        $teacherFromSchoolYear = $_POST['teacherFromSchoolYear'];
        $teacherToSchoolYear = $_POST['teacherToSchoolYear'];
        $studentYear = $teacherFromSchoolYear.'-'.$teacherToSchoolYear;

        $qrValue = $studentNumber;
        $dateAdded = date('Y-m-d');

        $addquery = "INSERT INTO student (accountID, firstname, middlename, lastname, studentNumber, studentBdate, 
        studentGender, studentSection, studentYear, qrImage, qrValue,dateAdded)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";

        $stmt = $pdo->prepare($addquery);
        $stmt->execute([$accountID, $firstname, $middlename, $lastname, $studentNumber, $studentBdate, $studentGender, 
        $studentFinalSection, $studentYear, $qrImage, $qrValue, $dateAdded]);

        // for admin recents
        $recentLabel='added';
        $recentDate = date("Y-m-d");
        // Set the timezone to Asia/Manila (Philippine time)
        date_default_timezone_set('Asia/Manila');
        $recentTime = date("H:i:s");

        $addrecent = "INSERT INTO recents (accountID, studentNumber, recentDate, recentTime, recentLabel)
        VALUES (?,?,?,?,?)";
        $stmt = $pdo->prepare($addrecent);
        $stmt->execute([$accountID, $studentNumber, $recentDate, $recentTime, $recentLabel]);

    } else{
        echo "error found";
    }


    QRcode :: png($qrValue,$qrcode,'H',4,4);
    // QRcode :: png("Test1",$qrcode,'H',4,4);
    // echo "<img src='".$qrcode."'>";
    header("Location: ../teacher/registration.php?header=Registration&studentAddSuccess");
    echo "Hui";
?>