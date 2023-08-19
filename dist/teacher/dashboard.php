<?php
    session_start();
    include '../connection/db_conn.php';
    include '../connection/session.php';
    include '../connection/session_name.php';

    // Totals
    $total_students = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM attendance_record WHERE accountID = '$accountID'")->fetchColumn();
    $total_students_male = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM attendance_record
            INNER JOIN  student WHERE attendance_record.studentNumber=student.studentNumber AND studentGender='Male'")->fetchColumn();
    $total_students_female = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM attendance_record
            INNER JOIN  student WHERE attendance_record.studentNumber=student.studentNumber AND studentGender='Female'")->fetchColumn();
    $total_section = $pdo->query("SELECT COUNT(DISTINCT studentSection, studentYear) FROM attendance_record
    INNER JOIN student ON attendance_record.studentNumber = student.studentNumber")->fetchColumn();

    // Fetch attendance table for section table
    $stmt = $pdo->prepare("SELECT * FROM attendance_record
            INNER JOIN student ON attendance_record.studentNumber = student.studentNumber GROUP BY studentSection, studentYear");
    $stmt->execute();
    $sectionRec = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch attendance table
    $stmt = $pdo->prepare("SELECT * FROM attendance_record INNER JOIN student ON attendance_record.studentNumber = student.studentNumber
    WHERE attendance_record.accountID='$accountID' ORDER BY attendanceID DESC");
    $stmt->execute();
    $fetchAttendance = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../css/main.css"> -->
    <?php include_once '../connection/link.php';?>
    <title>Document</title>
</head>
<body>
    <?php include_once '../navbar/topbar-teacher.php';?>
    <?php include_once '../navbar/sidebar-teacher.php';?>

    <section class="dashboard-teacher-main-container">
        <div class="main-body-content">
            <div class="total-section-teacher">
                <h1><?php echo $total_students;?></h1>
                <div class="school-name">
                    <p>Governor Ferrer Memorial National Highschool</p>
                    <p><span class="school-label">Total Attendance Students</span></p>
                </div>
                <button>View Report</button>
            </div>

            <div class="total-category-teacher">
                <div class="per-category">
                    <div class="category">
                        <div class="male-img">
                            <img src="../img/male-icon.png" alt="">
                        </div>
                        <div class="male-caption">
                            <h1><?php echo $total_students_male?> <span>total</span></h1>
                            <p>Male Student</p>
                        </div>
                    </div>
                    <div class="category">
                        <div class="female-img">
                            <img src="../img/female-icon.png" alt="">
                        </div>
                        <div class="female-caption">
                            <h1><?php echo $total_students_female?> <span>total</span></h1>
                            <p>Female Student</p>
                        </div>
                    </div>
                    <div class="category">
                        <div class="prof-img">
                            <img src="../img/prof-icon.png" alt="">
                        </div>
                        <div class="prof-caption">
                            <h1><?php echo $total_section?> <span>total</span></h1>
                            <p>Section</p>
                        </div>
                    </div>
                </div>
                <div class="table-category">
                    <table id="section" class="display">
                    <thead>
                        <tr>
                            <th>Section Name</th>
                            <th>School Year</th>
                            <th>Total Number</th>
                        </tr>
                    </thead>
                    <?php foreach($sectionRec as $section){
                         $studentSection= $section['studentSection'];
                         $studentYear= $section['studentYear'];
                         $totality = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM attendance_record
                         INNER JOIN  student WHERE attendance_record.studentNumber=student.studentNumber AND studentSection='$studentSection' 
                         AND studentYear='$studentYear'")->fetchColumn();
                    ?>
                    <tbody>
                        <tr>
                            <td><?php echo $studentSection?></td>
                            <td><?php echo $studentYear?></td>
                            <td><?php echo $totality?></td>
                        </tr>
                    </tbody>
                    <?php } ?>
                </table>
                </div>
            </div>
        </div>
    </section>

    <section class="latest-attendance-teacher">
        <h1>Latest Attendance</h1>
        <div class="container-latest-att">
            <div class="circle-design">
                <p class="circle-green"></p>
                <p class="circle-green"></p>
                <p class="circle-green"></p>
            </div>
            <br>
            <table id="student" class="display">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Section</th>
                        <th>School Year</th>
                        <th>Subject</th>
                        <th>Time-in</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <?php foreach($fetchAttendance as $attendance){
                    // Time Format
                    $time = new DateTime($attendance['qrTime']);
                    $formattedTime = $time->format('g:i A');
                ?>
                <tbody>
                    <tr>
                        <td><?php echo $attendance['firstname'].' '.$attendance['middlename'].' '.$attendance['lastname']?></td>
                        <td><?php echo $attendance['studentSection']?></td>
                        <td><?php echo $attendance['studentYear']?></td>
                        <td><?php echo $attendance['qrSubject']?></td>
                        <td><?php echo $formattedTime?></td>
                        <td><button class="view">Visit Profile</button></td>
                    </tr>
                </tbody>
                <?php }?>
            </table>
        </div>
    </section>
</body>
<script>    
    new DataTable('#student');
    new DataTable('#section');
</script>
</html>