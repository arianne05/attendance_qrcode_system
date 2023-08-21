<?php
include '../../connection/db_conn.php';

$date_from = $_GET['date_from'];
$date_to = $_GET['date_to'];
$accountID= $_GET['accountID'];

if($date_from == ''){
    $date_from_display = 'NA';
}else{
    $date_from_display = $_GET['date_from'];
}
if($date_to == ''){
    $date_to_display = 'NA';
}else{
    $date_to_display = $_GET['date_to'];
}


if (!empty($date_from) && empty($date_to)) {
    // Totals
    $total_attendance_student = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM attendance_record WHERE accountID='$accountID' AND qrDate = '$date_from'")->fetchColumn();
    $total_attendance_male = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM attendance_record 
    INNER JOIN student WHERE attendance_record.studentNumber=student.studentNumber 
    AND attendance_record.accountID='$accountID' AND student.studentGender='Male'
    AND attendance_record.qrDate = '$date_from'")->fetchColumn();
    $total_attendance_female = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM attendance_record 
    INNER JOIN student WHERE attendance_record.studentNumber=student.studentNumber 
    AND attendance_record.accountID='$accountID' AND student.studentGender='Female'
    AND attendance_record.qrDate = '$date_from'")->fetchColumn();

    // Fetch login_act table and student table
    $stmt = $pdo->prepare("SELECT * FROM attendance_record WHERE accountID='$accountID' AND qrDate = '$date_from'");
    $stmt->execute();
    $fetchAttendance = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $stmt = $pdo->prepare("SELECT * FROM attendance_record WHERE accountID='$accountID' AND qrDate = '$date_from' GROUP BY qrSection");
    $stmt->execute();
    $fetchTotal = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Assuming $accountID is a safe and validated value from user input
    $stmt = $pdo->prepare("SELECT firstname, middlename, lastname FROM account_information WHERE accountID = :accountID");
    $stmt->bindParam(':accountID', $accountID, PDO::PARAM_INT); // Assuming accountID is an integer, adjust the data type accordingly if needed
    $stmt->execute();
    $nameData = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (!empty($date_from) && !empty($date_to)) { //WHEN BOTH DATE IS SELECTED
    // Totals
    $total_attendance_student = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM attendance_record WHERE accountID='$accountID' AND qrDate >= '$date_from' AND qrDate <= '$date_to'")->fetchColumn();
    $total_attendance_male = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM attendance_record 
    INNER JOIN student WHERE attendance_record.studentNumber=student.studentNumber 
    AND attendance_record.accountID='$accountID' AND student.studentGender='Male'
    AND attendance_record.qrDate >= '$date_from' AND attendance_record.qrDate <= '$date_to'")->fetchColumn();
    $total_attendance_female = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM attendance_record 
    INNER JOIN student WHERE attendance_record.studentNumber=student.studentNumber 
    AND attendance_record.accountID='$accountID' AND student.studentGender='Female'
    AND attendance_record.qrDate >= '$date_from' AND attendance_record.qrDate <= '$date_to'")->fetchColumn();

    // Fetch login_act table and student table
    $stmt = $pdo->prepare("SELECT * FROM attendance_record WHERE accountID='$accountID' AND qrDate >= '$date_from' AND qrDate <= '$date_to'");
    $stmt->execute();
    $fetchAttendance = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("SELECT * FROM attendance_record WHERE accountID='$accountID' AND qrDate >= '$date_from' AND qrDate <= '$date_to' GROUP BY qrSection");
    $stmt->execute();
    $fetchTotal = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Assuming $accountID is a safe and validated value from user input
    $stmt = $pdo->prepare("SELECT firstname, middlename, lastname FROM account_information WHERE accountID = :accountID");
    $stmt->bindParam(':accountID', $accountID, PDO::PARAM_INT); // Assuming accountID is an integer, adjust the data type accordingly if needed
    $stmt->execute();
    $nameData = $stmt->fetch(PDO::FETCH_ASSOC);
    
}

if (empty($date_from) && empty($date_to)) { //WHEN BOTH DATE IS EMPTY
    // Totals
    $total_attendance_student = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM attendance_record WHERE accountID='$accountID'")->fetchColumn();
    $total_attendance_male = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM attendance_record 
    INNER JOIN student WHERE attendance_record.studentNumber=student.studentNumber 
    AND attendance_record.accountID='$accountID' AND student.studentGender='Male'")->fetchColumn();
    $total_attendance_female = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM attendance_record 
    INNER JOIN student WHERE attendance_record.studentNumber=student.studentNumber 
    AND attendance_record.accountID='$accountID' AND student.studentGender='Female'")->fetchColumn();
    $total_ontime = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM attendance_record WHERE accountID='$accountID' AND qrLabel='on-time' GROUP BY qrLabel")->fetchColumn();
    $total_late = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM attendance_record WHERE accountID='$accountID' AND qrLabel='late' GROUP BY qrLabel")->fetchColumn();

    // Fetch login_act table and student table
    $stmt = $pdo->prepare("SELECT * FROM attendance_record WHERE accountID='$accountID'");
    $stmt->execute();
    $fetchAttendance = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("SELECT * FROM attendance_record WHERE accountID='$accountID' GROUP BY qrSection");
    $stmt->execute();
    $fetchTotal = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Assuming $accountID is a safe and validated value from user input
    $stmt = $pdo->prepare("SELECT firstname, middlename, lastname FROM account_information WHERE accountID = :accountID");
    $stmt->bindParam(':accountID', $accountID, PDO::PARAM_INT); // Assuming accountID is an integer, adjust the data type accordingly if needed
    $stmt->execute();
    $nameData = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="main-header">
        <table class="main-header-table">
            <td class="headerLeft">
                <img src="../../img/cvsu_logo.png" width="50" height="50">
            </td>
            <td class="headerRight">
                <div class="caption-main-header">
                    <p><b>Biclatan National Highschool</b></p>
                    <p>San Isidro Labrador I</p>
                    <p>Dasmarinas City Cavite</p>
                </div>
            </td>
        </table>
    </div>
    <center class="preparedBy">
        <br>
        <h3>Student Attendance Reports</h3>
        <p>prepared by: <?php echo $nameData['firstname'].' '.$nameData['middlename'].' '.$nameData['lastname']?></p>
    </center>
    
    <br><br>
    <div class="sub-header">
        <table class="sub-header-table">
            <td class="subHeaderLeft">
                <h3>Total Record: <?php echo $total_attendance_student?></h3>
                <p>Total Male: <?php echo $total_attendance_male;?></p>
                <p>Total Female: <?php echo $total_attendance_female;?></p>
                <p><span class="greenTime">on-time :</span> <?php echo $total_ontime?></p>
                <p><span class="redLate">late :</span> <?php echo $total_late?></p>
            </td>
            <?php for($i=1; $i<=7; $i++){?>
            <td class="subHeaderEmpty"></td>
            <?php }?>
            <td class="subHeaderRight">
                <div class="date">
                    <p>Date From: <?php echo $date_from_display?></p>
                    <p>Date To: <?php echo $date_to_display?></p>
                </div>
            </td>
        </table>
    </div>
    
    <br>
    <p class="totalPerSecLabel"><b>Total per Section</b></p>
    <hr>
    <?php foreach($fetchTotal as $totalPerSec){
        $total_per = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM attendance_record WHERE accountID='$accountID' GROUP BY qrSection")->fetchColumn();
    ?>
        <p class="totalPerSection"><?php echo $totalPerSec['qrSection']?> : <?php echo $total_per?></p>
    <?php }?>
    <br>
    <table class="main-table-user">
        <thead>
            <tr class="mainTableLeft">
                <th>Student Number</th>
                <th>Name</th>
                <th>Sex</th>
                <th>Section</th>
                <th>Subject</th>
                <th>Time-in</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <?php foreach($fetchAttendance as $attendance){
            $studentNumber=$attendance['studentNumber'];
            // Time Format
            $time = new DateTime($attendance['qrTime']);
            $formattedTime = $time->format('g:i A');

            // Fetch login_act table and student table
            $stmt = $pdo->prepare("SELECT * FROM student WHERE studentNumber='$studentNumber'");
            $stmt->execute();
            $fetchStudent = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($fetchStudent as $student){
        ?>
        <tbody> <!-- Move the <tbody> tag here -->
            <tr class="mainTableRight">
                <td><?php echo $student['studentNumber']?></td>
                <td><?php echo $student['firstname'].' '.$student['middlename'].' '.$student['lastname']?></td>
                <td><?php echo $student['studentGender']?></td>   
                <td><?php echo $attendance['qrSection']?></td>
                <td><?php echo $attendance['qrSubject']?></td>
                <td><?php echo $formattedTime?></td>
                <td><?php echo $attendance['qrDate']?></td>
                <td><?php echo $attendance['qrLabel']?></td>
            </tr>
        </tbody>
        <?php } }?>
    </table>
</body>
</html>

<style>
    .main-header{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .caption-main-header p{
        padding: 0;
        margin: 0;
    }
    .main-header-table{
        margin: 0 auto;
        border-collapse: collapse;
        border: none;
    }
    .headerRight{
        text-align: center;
        border: none;
    }
    .headerLeft{
        text-align: right;
        border: none;
    }


    .sub-header-table{
        width: 100%;
        padding: 0;
        border-collapse: collapse;
    }
    .subHeaderRight{
        margin: 0;
        padding: 0;
        text-align: left;
        border: none;
    }
    .subHeaderLeft{
        margin: 0;
        padding: 0;
        border: none;
    }
    .subHeaderEmpty{
        padding-right: 20px;
        border: none;
    }
    .subHeaderLeft h3{
        margin: 0;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .subHeaderLeft p{
        margin: 0;
        padding: 0;
    }
    .date p{
        padding: 0;
        margin: 0;
    }

    .main-table-user{
        width: 100%;
        padding: 7px;
    }
    .main-table-user thead{
        border-bottom: 2px solid black;
    }
    .mainTableLeft th{
        text-align: left;
        padding: 5px;
    }
    .mainTableRight td{
        padding: 5px;
    }
    .preparedBy p, h3{
        margin: 0;
        padding: 0;
    }
    .totalPerSecLabel{
        margin: 0;
        padding: 0;
    }
    .totalPerSection{
        margin: 0;
        padding: 0;
    }
    .greenTime{
        color: green;
    }
    .redLate{
        color: red;
    }
</style>