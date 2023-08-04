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

        $addquery = "INSERT INTO student (accountID, firstname, middlename, lastname, studentNumber, studentBdate, 
        studentGender, studentSection, studentYear, qrImage, qrValue)
        VALUES (?,?,?,?,?,?,?,?,?,?,?)";

        $stmt = $pdo->prepare($addquery);
        $stmt->execute([$accountID, $firstname, $middlename, $lastname, $studentNumber, $studentBdate, $studentGender, 
        $studentFinalSection, $studentYear, $qrImage, $qrValue]);
    } else{
        echo "error found";
    }


    QRcode :: png($qrValue,$qrcode,'H',4,4);
    // QRcode :: png("Test1",$qrcode,'H',4,4);
    // echo "<img src='".$qrcode."'>";
    header("Location: ../admin/student.php?header=Student");
    echo "Hui";
?>