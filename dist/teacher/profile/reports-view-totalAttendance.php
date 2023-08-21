<?php
    session_start();
    include '../../connection/db_conn.php';
    include '../../connection/session.php';
    include '../../connection/session_name.php';
    include '../queries/report-sort-date-attendance.php';
   
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../../connection/link.php'?>
    <title>Document</title>
</head>
<body>
    <!-- Topbar -->
    <?php include_once '../../navbar/topbar-teacher.php';?>
    <!-- Sidebar -->
    <?php include_once '../../navbar/sidebar-teacher.php';?>

    <form action="" method="GET">
        <?php
                $date_from2 = isset($_GET['date_from']) ? $_GET['date_from'] : '';
                $date_to2 = isset($_GET['date_to']) ? $_GET['date_to'] : '';
                if (empty($date_from2)) {
                    $datemd_from = '';
                } else {
                    $datemd_from = date("mdY", strtotime($date_from2));
                }
                if (empty($date_to2)) {
                    $datemd_to = '';
                } else {
                    $datemd_to = date("mdY", strtotime($date_to2));
                }
            ?>
        <div class="sort-menu-report">
            <div class="date-container">
                <div class="datefrom">
                    <label for="Date From">Date From</label>
                    <input type="date" name="date_from" value="<?php echo $date_from2 ?>" required>
                </div>
                <div class="dateto">
                    <label for="Date To">Date To</label>
                    <input type="date" name="date_to" value="<?php echo $date_to2 ?>">
                    <input type="hidden" name="header" value="Reports">
                </div>
                <button type="submit" name="sort_date">Sort</button>
            </div>
        </div>
    </form>

    <section class="main-container-recents-report">
        <div class="recent-registered">
            <div class="header-with-button">
                <p class="header-activity">Total Record Attendance: <?php echo $total_attendance_student?></p>
                <div class="buttons">
                    <button class="pdfRed" onclick="window.open('../queries/download-pdf-report-reg.php?date_from=<?php echo $date_from2?>&date_to=<?php echo $date_to2?>&accountID=<?php echo $accountID?>&totalAtt')"><i class="fa-regular fa-file-pdf"></i></button>
                    <button class="csvGreen"><a href="../queries/download-csv-att.php?date_from=<?php echo $date_from2?>&date_to=<?php echo $date_to2?>&accountID=<?php echo $accountID?>&sort_date"><i class="fa-solid fa-file-csv"></i></a></button>
                </div>
            </div>
          <!-- Table -->
          <div class="table-recent">
          <table id="RecentReg" class="display">
              <thead>
                  <tr>
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
              <tbody>
                <tr>
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
          </div>
        </div>
    </section>
</body>
<script>    
    new DataTable('#RecentReg');
</script>
</html>