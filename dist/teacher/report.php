<?php
    session_start();
    include '../connection/db_conn.php';
    include '../connection/session.php';
    include '../connection/session_name.php';

    // Totals
    $total_section = $pdo->query("SELECT COUNT(DISTINCT studentSection, studentYear) FROM student WHERE accountID = '$accountID'")->fetchColumn();
    $total_attendance = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM attendance_record WHERE accountID='$accountID'")->fetchColumn();
    $total_register_users = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM student WHERE accountID='$accountID'")->fetchColumn();

    $currentDate = date('Y-m-d');
    $date = new DateTime($currentDate);
    $formattedDate = $date->format('M d, Y');

    // Total Registered Today
    $total_attendance_today = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM attendance_record WHERE accountID='$accountID' AND qrDate='$currentDate'")->fetchColumn();
    $total_students_today = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM student WHERE dateAdded='$currentDate'")->fetchColumn();


    // Fetch login_act table
    $stmt = $pdo->prepare("SELECT * FROM student");
    $stmt->execute();
    $fetchRegStudent = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch account table
    $stmt = $pdo->prepare("SELECT * FROM attendance_record 
    INNER JOIN student WHERE attendance_record.studentNumber=student.studentNumber
    AND attendance_record.qrDate='$currentDate' ORDER BY attendanceID DESC");
    $stmt->execute();
    $fetchAttendance = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include '../connection/link.php'?>
    <title>Document</title>
  </head>
  <body>
    <?php include_once '../navbar/topbar-teacher.php';?>
    <?php include_once '../navbar/sidebar-teacher.php';?>
    
    <section class="reports-total-container">
      <a href="./profile/reports-view-totalRegister.php?header=Reports" class="total-user">
          <div class="circle-user">
            <p></p>
          </div>
          <div class="total-text">
            <p class="Totalnumber"><?php echo $total_register_users; ?></p>
            <p>Total Registered Student</p>
          </div>
      </a>
      <a href="./profile/reports-view-totalStudent.php?header=Reports" class="total-student">
        <div class="circle-user">
              <p></p>
          </div>
          <div class="total-text">
            <p class="Totalnumber"><?php echo $total_attendance;?></p>
            <p>Total Student Attendance</p>
          </div>
      </div>
      <a href="./profile/reports-view-totalTeacher.php?header=Reports" class="total-teacher">
        <div class="circle-user">
              <p></p>
          </div>
          <div class="total-text">
            <p class="Totalnumber"><?php echo $total_section; ?></p>
            <p>Total Section Handled</p>
          </div>
      </a>
    </section>

    <section class="reports-pie-chart">
     
        <div class="recent-login">
            <!-- Header -->
            <p class="header-activity">Registered Student</p>
            <p class="sub-activity">Latest registered student today</p>

            <!-- Table -->
            <div class="table-recent">
            <table id="loginToday" class="display">
              <thead>
                  <tr>
                      <th></th>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Option</th>
                  </tr>
              </thead>
              <?php foreach($fetchRegStudent as $student){
              ?>
              <tbody>
                <tr class="test">
                    <td class="centerTD"><p class="initials-bg">AQ</p></td>
                    <td><?php echo $student['firstname'].' '.$student['lastname']?></td>
                    <td class="formatDate">recent</span></td>
                    <td>
                      <a href="./profile/student-view.php?header=<?php echo $student['firstname']?>'s Profile&id=<?php echo $student['studentID']?>&studNum=<?php echo $student['studentNumber']?>">
                        <button class="view">Detail</button>
                      </a>
                    </td>
                </tr>
              </tbody>
              <?php } ?>
            </table>
              </div>
          </div>
      

      <div class="registered-number">
        <p class="header-activity">Today's Activity</p>
        <p class="sub-activity">Recent users account added today <span class="formatDate"><?php echo $formattedDate?></span></p>
        <div class="user-activity-today">
            <div id="piechart"></div>
      </div>
    </section>

    <!-- Third Section -->
    <section class="main-container-recents">

        <div class="recent-registered">
          <p class="header-activity">Today Attendance</p>
          <p class="sub-activity">Student attendance record today</p>
          <!-- Table -->
          <div class="table-recent">
          <table id="RecentReg" class="display">
              <thead>
                  <tr>
                      <th>Student Number</th>
                      <th>Name</th>
                      <th>Section</th>
                      <th>School Year</th>
                      <th>Time-in</th>
                  </tr>
              </thead>
              <?php foreach($fetchAttendance as $attendance){
                // Time Format
                $time = new DateTime($attendance['qrTime']);
                $formattedTime = $time->format('g:i A');
              ?>
              <tbody>
                <tr>
                    <td><?php echo $attendance['studentNumber']?></td>
                    <td><?php echo $attendance['firstname'].' '.$attendance['middlename'].' '.$attendance['lastname']?></td>
                    <td><?php echo $attendance['studentSection']?></td>
                    <td><?php echo $attendance['studentYear']?></td>
                    <td><span class="formatDate"><?php echo $formattedTime?></span></td>
                </tr>
              </tbody>
              <?php } ?>
            </table>
          </div>
        </div>
      
    </section>

  </body>
  <!-- JS -->
  <script src="../js/report-chart.js"></script>
  <script src="../js/alert.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script>    
    new DataTable('#loginToday');
    new DataTable('#RecentReg');
  </script>
  <script type="text/javascript">
      google.charts.load('current', {
          'packages': ['corechart']
      });

      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

          var data = google.visualization.arrayToDataTable([
              ['Resident Population', 'Total Numbers'],
              ['Register', <?php echo $total_students_today?>],
              ['Attendance', <?php echo $total_attendance_today?>]
          ]);

          var options = {
              // title: 'My Daily Activities'
              sliceVisibilityThreshold: 0,
              width: '100%',
              height: '100%',
              legend: {
                  position: 'bottom',
                  alignment: 'center'
              },
              colors: ['#fc7777', '#6dabc6']

          };

          var chart = new google.visualization.PieChart(document.getElementById('piechart'));
          chart.draw(data, options);
      }

      window.addEventListener('load', drawChart);
      window.addEventListener('resize', drawChart);

      $(document).ready(function() {
          $(window).resize(function() {
              drawChart();
          });
      });
  </script>
</html>
