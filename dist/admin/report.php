<?php
    session_start();
    include '../connection/db_conn.php';
    if (!isset($_SESSION['accountID'])) {
        // Redirect the user to the login page
        header("Location: ../index.php?errorSession");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Links -->
    <link rel="stylesheet" href="../css/main.css">
    <script src="https://kit.fontawesome.com/8b614ed6c5.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- Sweet Alert -->
    <script src="../js/sweetalert.min.js"></script>
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
            <p>124</p>
            <p>Total Users</p>
          </div>
      </div>
      <div class="total-student">
        <div class="circle-user">
              <p></p>
          </div>
          <div class="total-text">
            <p>124</p>
            <p>Total Student</p>
          </div>
      </div>
      <div class="total-teacher">
      <div class="circle-user">
              <p></p>
          </div>
          <div class="total-text">
            <p>124</p>
            <p>Total Teachers</p>
          </div>
      </div>
    </section>

    <section class="reports-pie-chart">
      <div id="columnchart_material"></div>
      <div class="registered-number">
        <p class="header-activity">User's Activity</p>
        <p class="sub-activity">Recent users activity today</p>
        <div class="user-activity-today">
            <div class="category-activity">
              <div class="division-activity">
                <p class="circle green"></p>
                <p>Registered User</p>
              </div>
              <p class="total-activity">0</p>
            </div>
            <div class="category-activity">
              <div class="division-activity">
                <p class="circle red"></p>
                <p>Student</p>
              </div>
              <p class="total-activity">0</p>
            </div>
            <div class="category-activity">
              <div class="division-activity">
                <p class="circle blue"></p>
                <p>Teacher</p>
              </div>
              <p class="total-activity">0</p>
            </div>
        </div>
      </div>
    </section>

    <!-- Third Section -->
    <section class="main-container-recents">
      
        <div class="recent-login">
          <!-- Header -->
          <p class="header-activity">Recent Login</p>
          <p class="sub-activity">Latest user login today</p>

          <!-- Table -->
          <div class="table-recent">
                <table>
                    <tr class="test">
                        <td><p class="initials-bg">AQ</p></td>
                        <td>Arianne H. Quimpo</td>
                        <td>October 02, 2023 <br>02:23pm</td>
                        <td>logged in</td>
                    </tr>
                    <tr class="test">
                        <td><p class="initials-bg">AQ</p></td>
                        <td>Arianne H. Quimpo</td>
                        <td>October 02, 2023 <br>02:23pm</td>
                        <td>logged in</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="recent-registered">
          <p class="header-activity">Recent Registered User</p>
          <p class="sub-activity">Latest user registered today</p>
          <!-- Table -->
          <div class="table-recent">
                <table>
                    <tr>
                        <td>Arianne H. Quimpo</td>
                        <td>0949 845 8348</td>
                        <td>aya@gmail.com</td>
                    </tr>
                    <tr>
                        <td>Arianne H. Quimpo</td>
                        <td>0949 845 8348</td>
                        <td>aya@gmail.com</td>
                    </tr>
                </table>
          </div>
        </div>
      
    </section>

  </body>
  <!-- JS -->
  <script src="../js/report-chart.js"></script>
  <script src="../js/alert.js"></script>
</html>
