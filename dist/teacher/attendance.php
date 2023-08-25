<?php
    session_start();
    include '../connection/db_conn.php';
    include '../connection/session.php';
    include '../connection/session_name.php';

    // Fetch attendance table for section table
    $stmt = $pdo->prepare("SELECT * FROM teacher_handle WHERE accountID = '$accountID' AND status='' GROUP BY section, schoolYear, subject");
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
            <a href="#" onclick="openModalDetailTeacher()" class="per-container">
                <div class="container-one addNew">
                    <div>
                        <h1>+ Add New</span>
                    </div>
                </div>
            </a>
            <?php foreach($sectionRec as $sec){
                $subject=$sec['subject'];
                $Getsection=$sec['section'];
                $total_per_section = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM attendance_record WHERE status='' AND qrSubject='$subject' AND qrSection='$Getsection' AND accountID='$accountID'")->fetchColumn();
                
                // Time Format
                $timeFrom = new DateTime($sec['schedFrom']);
                $formattedTimeFrom = $timeFrom->format('g:i A');
                $timeTo = new DateTime($sec['schedTo']);
                $formattedTimeTo = $timeTo->format('g:i A');
                
                $getPath ='accountID='.$accountID.'&qrSubjec='.$subject.'&qrSection='.$Getsection.'&handleID='.$sec['handleID'];
            ?>
            <a href="./attendance-qr.php?header=Attendance&<?php echo $getPath?>" class="per-container">
                <div class="container-one">
                    <img src="../img/male-icon.png" alt="">
                    <div class="header-attendance">
                        <div class="text">
                            <h1><?php echo $total_per_section?> <span class="totalClass">TOTAL</span>
                            <h3><?php echo $sec['section']?></h3>
                            <p>Schedule: <?php echo $formattedTimeFrom.' '.$formattedTimeTo?></p>
                            <p>School Year: <?php echo $sec['schoolYear']?></p>
                        </div>
                        <div class="iconTrash">
                            <button type="button" onclick="removeSchedule('<?php echo $sec['handleID']; ?>')"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                </div>
            </a>
            <?php }?>
        </div>
    </section>
    <?php include_once './modal/add-schedule.php';?>
</body>
<script src="../js/modal.js"></script>
<script src="../js/addInputType.js"></script>
<script>
    // Remove Alert
    function removeSchedule(handleID) {
        Swal.fire({
            icon: "question",
            title: "Remove",
            text: "Are you sure you want to remove this section?",
            showCancelButton: true,
        }).then(function (result) {
            if (result.isConfirmed) {
                // Redirect to the PHP script with the accountID parameter
                window.location.href = `./queries/add-sched-query.php?remove&handleID=${handleID}`;
            }
        });
    }
</script>

</html>