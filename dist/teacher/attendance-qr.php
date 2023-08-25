<?php
    session_start();
    include '../connection/db_conn.php';
    include '../connection/session.php';
    include '../connection/session_name.php';

    if(isset($_GET['qrSection']) && isset($_GET['qrSubjec'])){
        $getSection= $_GET['qrSection'];
        $getSubject= $_GET['qrSubjec'];
    }
    
    $getDate=date("Y-m-d");

    // Fetch attendance table
    $stmt = $pdo->prepare("SELECT * FROM attendance_record WHERE accountID='$accountID' AND status='' AND qrSubject='$getSubject' AND qrSection='$getSection' AND qrDate='$getDate'");
    $stmt->execute();
    $fetchAttendance = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    <section class="section-camera">
        <div class="vid-preview">
            <div class="preview-cam">
                <video id="preview" width="100%"></video>
            </div>
            <div class="preview-scan-info">
                <div class="img-studentNumber">
                    <img src="../img/female-icon.png" alt="">
                    <p id="text2"></p>
                </div>
                
                <form action="./queries/student-query.php" method="post">
                <div class="scan-header">
                    <?php 
                        if(isset($_GET['fullname']) && isset($_GET['studSec']) && isset($_GET['studYear'])){
                            $fullname=$_GET['fullname'];
                            $studSec=$_GET['studSec'];
                            $studYear=$_GET['studYear'];
                        } else{
                            $fullname='';
                            $studSec='';
                            $studYear='';
                        }
                    ?>
                    <div class="by-label">
                        <label for="">Name</label>
                        <input type="text" value="<?php echo $fullname?>" readonly placeholder="Scan QR">
                        <input type="hidden" name="text" id="text" readonly placeholder="Scan QR Here">
                    </div>
                    <div class="by-label">
                        <label for="">Section</label>
                        <input type="text" value="<?php echo $studSec?>" readonly placeholder="Scan QR">
                    </div>
                    <div class="by-label">
                        <label for="">School Year</label>
                        <input type="text" value="<?php echo $studYear?>" readonly placeholder="Scan QR">
                        <input type="hidden" name="accountID" value="<?php echo $_GET['accountID']?>">
                        <input type="hidden" name="qrSubject" value="<?php echo $_GET['qrSubjec']?>">
                        <input type="hidden" name="qrSection" value="<?php echo $_GET['qrSection']?>">
                        <input type="hidden" name="handleID" value="<?php echo $_GET['handleID']?>">
                    </div>
                </div>
                </form>
            </div>
        </div>

        <div class="tbl-attendance">
            <br><h2>Record</h2><br>
            <div class="container-tbl-att">
            <div class="circle-design">
                <p class="circle-green"></p>
                <p class="circle-green"></p>
                <p class="circle-green"></p>
            </div>
            <br>
            <table id="student" class="display">
                <thead>
                    <th>Student Number</th>
                    <th>Name</th>
                    <th>Section</th>
                    <th>Subject</th>
                    <th>Time-in</th>
                    <th>Status</th>
                    <th>Option</th>
                </thead>
                <?php foreach($fetchAttendance as $attendane){ 
                    $studentNumber=$attendane['studentNumber'];

                    // Time Format
                    $time = new DateTime($attendane['qrTime']);
                    $formattedTime = $time->format('g:i A');

                    // Student Name
                    $stmt = $pdo->prepare("SELECT * FROM student WHERE studentNumber = :studentNumber");
                    $stmt->bindParam(':studentNumber', $studentNumber, PDO::PARAM_INT);
                    $stmt->execute();
                    $student = $stmt->fetch(PDO::FETCH_ASSOC);

                    //Teacher Sched Label
                    $qrSubject=$attendane['qrSubject'];
                    $qrSection=$attendane['qrSection'];
                    $qrTime=$attendane['qrTime'];

                    $stmt = $pdo->prepare("SELECT * FROM teacher_handle WHERE subject = :subject AND section = :section");
                    $stmt->bindParam(':subject', $subject, PDO::PARAM_STR); // Change to PDO::PARAM_STR
                    $stmt->bindParam(':section', $section, PDO::PARAM_STR); // Change to PDO::PARAM_STR
                    $stmt->execute();
                    $section = $stmt->fetch(PDO::FETCH_ASSOC);

                    // $fromTime=$section['schedFrom'];
                    
                    // Calculate the time difference in minutes
                    // $qrTimeObj = new DateTime($qrTime);
                    // $fromTimeObj = new DateTime($section['schedFrom']);
                    // $interval = $fromTimeObj->diff($qrTimeObj);
                    // $minutesLate = $interval->format('%i'); // Get the minutes part of the difference

                    // if ($minutesLate < 15) {
                    //     $label = 'late';
                    // } else {
                    //     $label = 'on time';
                    // }

                ?>
                <tbody>
                    <td><?php echo $attendane['studentNumber']?></td>
                    <td><?php echo $student['firstname'].' '.$student['middlename'].' '.$student['lastname']?></td>
                    <td><?php echo $student['studentSection']?></td>
                    <td><?php echo $attendane['qrSubject']?></td>
                    <td><?php echo $formattedTime?></td>
                    <td>NA</td>
                    <td><button class="archive" onclick="removeAttendance('<?php echo $attendane['attendanceID'];?>','<?php echo $attendane['studentNumber'];?>','<?php echo $accountID?>','<?php echo $_GET['qrSubjec'];?>','<?php echo $_GET['qrSection'];?>','<?php echo $_GET['handleID'];?>')" name="removeAttendance">Remove</button></td>
                </tbody>
                <?php }?>
            </table>
            </div>
        </div>
    </section>
</body>
<script>    
    new DataTable('#student');
</script>
<script>
        let scanner = new Instascan.Scanner({video: document.getElementById('preview')});
        Instascan.Camera.getCameras().then(function(cameras){
            if(cameras.length > 0){
                scanner.start(cameras[0]);
            } else{
                alert("No Camera Found!");
            }
        }).catch(function(e){
            console.error(e);
        });

        scanner.addListener('scan',function(c){
            document.getElementById('text').value=c; //display value in input tag
            document.getElementById('text2').textContent = c; //display id in p tag
            document.forms[0].submit();
        });
</script>
<!-- Sweet Alert -->

<?php 
    if(isset($_GET['successAttendance'])){
        ?>
            <script>
                Swal.fire(
                'Attendance Recorded!',
                'Your on time!',
                'success'
                )
            </script>
        <?php
    }
?>
<?php 
    if(isset($_GET['removeAttendanceSuccess'])){
        ?>
            <script>
                Swal.fire(
                'Attendance Removed!',
                'Click to continue!',
                'success'
                )
            </script>
        <?php
    }
?>

<!-- Sweet Alert Removed -->
<script>
    // Removes Alert
    function removeAttendance(attendanceID, studentNumber, accountID, qrSubjec, qrSection, handleID) {
        Swal.fire({
            icon: "question",
            title: "Remove",
            text: "Are you sure you want to remove this record?",
            showCancelButton: true,
        }).then(function (result) {
            if (result.isConfirmed) {
                // Redirect to the PHP script with the accountID parameter
                window.location.href = `./queries/student-query.php?removeAttendance&attendanceID=${attendanceID}&studentNumber=${studentNumber}&accountID=${accountID}&qrSubjec=${qrSubjec}&qrSection=${qrSection}&handleID=${handleID}`;
            }
        });
    }
</script>

</html>