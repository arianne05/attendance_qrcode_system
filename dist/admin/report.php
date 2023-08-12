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

    // Fetch login_act table
    $stmt = $pdo->prepare("SELECT * FROM login_activity");
    $stmt->execute();
    $login = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch account table
    $stmt = $pdo->prepare("SELECT * FROM account_information WHERE position='teacher' and dateAdded='$currentDate'");
    $stmt->execute();
    $recenReg = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
      <a href="./profile/reports-view.php?header=Reports" class="total-user">
          <div class="circle-user">
            <p></p>
          </div>
          <div class="total-text">
            <p class="Totalnumber"><?php echo $total_users; ?></p>
            <p>Total Users</p>
          </div>
      </a>
      <a href="#" class="total-student">
        <div class="circle-user">
              <p></p>
          </div>
          <div class="total-text">
            <p class="Totalnumber"><?php echo $total_students;?></p>
            <p>Total Student</p>
          </div>
      </div>
      <a href="" class="total-teacher">
        <div class="circle-user">
              <p></p>
          </div>
          <div class="total-text">
            <p class="Totalnumber"><?php echo $total_prof; ?></p>
            <p>Total Teachers</p>
          </div>
      </a>
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
              <?php foreach($login as $logins){
                  $accountID = $logins['accountID'];
                  $time = new DateTime($logins['logTime']);
                  $formattedTime = $time->format('g:i A');
                  $logLabel=$logins['logLabel'];
                  if($logLabel=='logged in'){
                    $className = 'formatDate';
                  } else{
                    $className = 'formatDateRed';
                  }

                  // Fetch account table
                  $stmt = $pdo->prepare("SELECT * FROM account_information WHERE position='teacher' and accountID='$accountID'");
                  $stmt->execute();
                  $teacher = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach($teacher as $teachers){
              ?>
              <tbody>
                <tr class="test">
                    <td class="centerTD"><p class="initials-bg">AQ</p></td>
                    <td><?php echo $teachers['firstname'].' '.$teachers['lastname']?></td>
                    <td><?php echo $formattedTime;?></td>
                    <td><span class="<?php echo $className?>"><?php echo $logins['logLabel']?></span></td>
                    <td>
                      <a href="./profile/teacher-view.php?header=<?php echo $teachers['firstname']?>'s Profile&id=<?php echo $accountID?>">
                        <button class="view">Detail</button>
                      </a>
                    </td>
                </tr>
              </tbody>
              <?php }} ?>
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
              <?php foreach($recenReg as $registerToday){
                if ($registerToday['status'] == 'active'){
                    $colorStatus = 'activeRed';
                    $colorLabel = 'labelactive';
                    $changeBtn = 'Deactivate';
                    $alert = 'deactivateAlert';
                }else{
                    $colorStatus = 'activeGreen';
                    $colorLabel = 'labeldeactive';
                    $changeBtn = 'Activate';
                    $alert = 'activateAlert';
                }
              ?>
              <tbody>
                <tr>
                    <td><?php echo $registerToday['accountID']?></td>
                    <td><?php echo $registerToday['firstname'].' '.$registerToday['middlename'].' '.$registerToday['lastname']?></td>
                    <td><?php echo $registerToday['faculty']?></td>
                    <td><?php echo $registerToday['username']?></td>
                    <td><span class="formatDate">recent</span></td>
                    <td>
                    <button type="button" class="<?php echo $colorStatus;?>" onclick="<?php echo $alert?>('<?php echo $registerToday['accountID']; ?>')"><?php echo $changeBtn?></button>
                    </td>
                </tr>
              </tbody>
              <?php }?>
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
              ['Student', <?php echo $total_students_today?>],
              ['Teacher', <?php echo $total_prof_today?>]
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

  <!-- Sweet Alert Deactivate -->
<script>
    // Deact Alert
    function deactivateAlert(accountID) {
        Swal.fire({
            icon: "question",
            title: "Deactivate",
            text: "Are you sure you want to deactivate this account?",
            showCancelButton: true,
        }).then(function (result) {
            if (result.isConfirmed) {
                // Redirect to the PHP script with the accountID parameter
                window.location.href = `./queries/teacher-query.php?deactivate&id=${accountID}`;
            }
        });
    }
</script>
<script>
    // Active Alert
    function activateAlert(accountID) {
        Swal.fire({
            icon: "question",
            title: "Activate",
            text: "Are you sure you want to activate this account?",
            showCancelButton: true,
        }).then(function (result) {
            if (result.isConfirmed) {
                // Redirect to the PHP script with the accountID parameter
                window.location.href = `./queries/teacher-query.php?activate&id=${accountID}`;
            }
        });
    }
</script>
</html>
