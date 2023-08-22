<?php
    session_start();
    include '../connection/db_conn.php';
    include '../connection/session.php';
    include '../connection/session_name.php';

    // Fetch attendance table for section table
    $stmt = $pdo->prepare("SELECT * FROM teacher_handle WHERE accountID = '$accountID' GROUP BY section, schoolYear, subject");
    $stmt->execute();
    $sectionRec = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../connection/link.php'?>
    <!-- Link -->
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <title>Document</title>
</head>
<body>
    <!-- Topbar -->
    <?php include_once '../navbar/topbar-teacher.php'?>
    <!-- Sidebar -->
    <?php include_once '../navbar/sidebar-teacher.php'?>
    <br>
    <section class="overview-attendance">
        <h2>My Section</h2>
        <div class="section-attendance-container">
            <a href="#" class="per-container">
                <div class="container-one addNew">
                    <div>
                        <h1>+ Add New</span>
                    </div>
                </div>
            </a>
            <?php foreach($sectionRec as $sec){
                $subject=$sec['subject'];
                $Getsection=$sec['section'];
                $total_per_section = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM attendance_record WHERE qrSubject='$subject' AND qrSection='$Getsection' AND accountID='$accountID'")->fetchColumn();
            ?>
            <a href="#" class="per-container">
                <div class="container-one">
                    <img src="../img/male-icon.png" alt="">
                    <div>
                        <h1><?php echo $total_per_section?> <span class="totalClass">TOTAL</span>
                        <h3><?php echo $sec['section']?></h3>
                        <p>Schedule: <?php echo $sec['schedule']?></p>
                        <p>School Year: <?php echo $sec['schoolYear']?></p>
                    </div>
                </div>
            </a>
            <?php }?>
        </div>
    </section>
</body>
</html>