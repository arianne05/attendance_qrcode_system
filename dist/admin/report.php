<?php
    session_start();
    include '../connection/db_conn.php';
    include '../connection/session.php';
    include '../connection/session_name.php';

    // Totals
    $total_prof = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM account_information WHERE position='teacher'")->fetchColumn();
    $total_students = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM student")->fetchColumn();
    $total_users = $total_prof + $total_students;

    $currentDate = date('Y-m-d');
    $date = new DateTime($currentDate);
    $formattedDate = $date->format('M d, Y');

    // Total Registered Today
    $total_prof_today = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM account_information WHERE position='teacher' AND dateAdded='$currentDate'")->fetchColumn();
    $total_students_today = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM recents WHERE recentDate='$currentDate' AND recentLabel='added'")->fetchColumn();
    $total_today = $total_prof_today + $total_students_today;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include '../connection/link.php'?>
    <title>Document</title>
  </head>
  <body>
    <!-- Topbar -->
    <?php include_once '../navbar/topbar.php'?>
    <!-- Sidebar -->
    <?php include_once '../navbar/sidebar.php'?>
    
    <section class="reports-total-container">
      <div class="total-user">
          <div class="circle-user">
            <p></p>
          </div>
          <div class="total-text">
            <p><?php echo $total_users; ?></p>
            <p>Total Users</p>
          </div>
      </div>
      <div class="total-student">
        <div class="circle-user">
              <p></p>
          </div>
          <div class="total-text">
            <p><?php echo $total_students;?></p>
            <p>Total Student</p>
          </div>
      </div>
      <div class="total-teacher">
      <div class="circle-user">
              <p></p>
          </div>
          <div class="total-text">
            <p><?php echo $total_prof; ?></p>
            <p>Total Teachers</p>
          </div>
      </div>
    </section>

    <section class="reports-pie-chart">
     
        <div class="recent-login">
            <!-- Header -->
            <p class="header-activity">Recent Login</p>
            <p class="sub-activity">Latest user login today</p>

            <!-- Table -->
            <div class="table-recent">
            <table id="loginToday" class="display">
              <thead>
                  <tr>
                      <th></th>
                      <th>Name</th>
                      <th>Time-in</th>
                      <th>Status</th>
                      <th>Option</th>
                  </tr>
              </thead>
              <tbody>
                <tr class="test">
                    <td class="centerTD"><p class="initials-bg">AQ</p></td>
                    <td>Arianne H. Quimpo</td>
                    <td>02:23 PM</td>
                    <td><span class="formatDate">logged in</span></td>
                    <td><button class="archive">Remove</button></td>
                </tr>
              </tbody>
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
          <p class="header-activity">Recent Registered User</p>
          <p class="sub-activity">Latest user registered today</p>
          <!-- Table -->
          <div class="table-recent">
          <table id="RecentReg" class="display">
              <thead>
                  <tr>
                      
                      <th>Employee Number</th>
                      <th>Name</th>
                      <th>Department</th>
                      <th>Username</th>
                      <th>Status</th>
                      <th>Option</th>
                  </tr>
              </thead>
              <tbody>
                <tr>
                    <td>201912344</td>
                    <td>Arianne H. Quimpo</td>
                    <td>English</td>
                    <td>Aya2t05</td>
                    <td><span class="formatDate">recent</span></td>
                    <td><button class="archive">Remove</button></td>
                </tr>
              </tbody>
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
              ['Student', <?php echo $total_students?>],
              ['Teacher', <?php echo $total_prof?>]
          ]);

          var options = {
              // title: 'My Daily Activities'
              sliceVisibilityThreshold: 0,
              width: '100%',
              height: '100%',
              legend: {
                  position: 'bottom',
                  alignment: 'center'
              }

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
