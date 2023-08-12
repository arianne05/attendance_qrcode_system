<?php
    session_start();
    include '../../connection/db_conn.php';
    include '../../connection/session.php';
    include '../../connection/session_name.php';
    include '../queries/report-sort-date.php';
    

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
                <p class="header-activity">Total Users: <?php echo $total_users?></p>
                <div class="buttons">
                    <button class="pdfRed" onclick="window.open('../queries/download-pdf-report.php?date_from=<?php echo $date_from2?>&date_to=<?php echo $date_to2?>')"><i class="fa-regular fa-file-pdf"></i></button>
                    <button class="csvGreen"><a href="../queries/download-csv.php?date_from=<?php echo $date_from2?>&date_to=<?php echo $date_to2?>&sort_date"><i class="fa-solid fa-file-csv"></i></a></button>
                    <button class="sqlBlue">SQL</button>
                </div>
            </div>
          <!-- Table -->
          <div class="table-recent">
          <table id="RecentReg" class="display">
              <thead>
                  <tr>
                      <th>ID Number</th>
                      <th>Name</th>
                      <th>Sex</th>
                      <th>Position</th>
                      <th>Date Added</th>
                  </tr>
              </thead>
            <?php foreach($users as $user){ 
            ?>
              <tbody>
                <tr>
                    <td><?php echo $user['accountID']?></td>
                    <td><?php echo $user['firstname'].' '.$user['middlename'].' '.$user['lastname']?></td>
                    <td><?php echo $user['sex']?></td>   
                    <td><?php echo $user['position']?></td>
                    <td><?php echo $user['dateAdded']?></td>
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