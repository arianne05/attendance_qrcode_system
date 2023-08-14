<?php
    session_start();
    include '../../connection/db_conn.php';
    include '../../connection/session.php';
    include '../../connection/session_name.php';
    include '../queries/report-sort-date-student.php';
    

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
    <?php include_once '../../navbar/topbar.php'?>
    <!-- Sidebar -->
    <?php include_once '../../navbar/sidebar.php'?>

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
                <p class="header-activity">Total Student Registered: <?php echo $total_students?></p>
                <div class="buttons">
                    <button class="pdfRed" onclick="window.open('../queries/download-pdf-report-student.php?date_from=<?php echo $date_from2?>&date_to=<?php echo $date_to2?>')"><i class="fa-regular fa-file-pdf"></i></button>
                    <button class="csvGreen"><a href="../queries/download-csv-student.php?date_from=<?php echo $date_from2?>&date_to=<?php echo $date_to2?>&sort_date"><i class="fa-solid fa-file-csv"></i></a></button>
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
                      <th>Position</th>
                      <th>Date Added</th>
                      <th>School Year</th>
                  </tr>
              </thead>
            <?php foreach($studentGet as $student){ 
            ?>
              <tbody>
                <tr>
                    <td><?php echo $student['studentNumber']?></td>
                    <td><?php echo $student['firstname'].' '.$student['middlename'].' '.$student['lastname']?></td>
                    <td><?php echo $student['studentGender']?></td>   
                    <td><?php echo 'student'?></td>
                    <td><?php echo $student['dateAdded']?></td>
                    <td><?php echo $student['studentYear']?></td>
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