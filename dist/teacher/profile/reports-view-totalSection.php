<?php
    session_start();
    include '../../connection/db_conn.php';
    include '../../connection/session.php';
    include '../../connection/session_name.php';
    include '../queries/report-sort-date-section.php';
   
    

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
                <p class="header-activity">General Report</p>
                <div class="buttons">
                    <button class="pdfRed" onclick="window.open('../queries/download-pdf-report-reg.php?date_from=<?php echo $date_from2?>&date_to=<?php echo $date_to2?>&accountID=<?php echo $accountID?>&totalSec')"><i class="fa-regular fa-file-pdf"></i></button>
                    <button class="csvGreen"><a href="../queries/download-csv-sec.php?date_from=<?php echo $date_from2?>&date_to=<?php echo $date_to2?>&accountID=<?php echo $accountID?>&sort_date"><i class="fa-solid fa-file-csv"></i></a></button>
                </div>
            </div>
          <!-- Table -->
          <div class="table-recent">
          <table id="RecentReg" class="display">
              <thead>
                  <tr>
                      <th>Section</th>
                      <th>School Year</th>
                      <th>Present Student</th>
                      <th>Subject</th>
                      <th>Schedule</th>
                  </tr>
              </thead>
            <?php foreach($fetchSection as $section){ 
                $subject=$section['subject'];
                $Getsection=$section['section'];
                if (!empty($date_from) && empty($date_to)) {
                    $total_per_section = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM attendance_record WHERE qrSubject='$subject' AND qrSection='$Getsection' AND accountID='$accountID' AND qrDate='$date_from'")->fetchColumn();
                } 
                if (!empty($date_from) && !empty($date_to)){
                    $total_per_section = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM attendance_record WHERE qrSubject='$subject' AND qrSection='$Getsection' AND accountID='$accountID' AND qrDate>='$date_from' AND qrDate<='$date_to'")->fetchColumn();
                }
                if (empty($date_from) && empty($date_to)){
                    $total_per_section = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM attendance_record WHERE qrSubject='$subject' AND qrSection='$Getsection' AND accountID='$accountID'")->fetchColumn();
                }
            ?>
              <tbody>
                <tr>
                    <td><?php echo $section['section']?></td>
                    <td><?php echo $section['schoolYear']?></td>
                    <td><?php echo $total_per_section?></td>   
                    <td><?php echo $section['subject']?></td>
                    <td><?php echo $section['schedule']?></td>
                </tr>
              </tbody>
            <?php } ?>
            </table>
          </div>
        </div>
    </section>
</body>
<script>    
    new DataTable('#RecentReg');
</script>
</html>