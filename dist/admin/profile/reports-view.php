<?php
    session_start();
    include '../../connection/db_conn.php';
    include '../../connection/session.php';
    include '../../connection/session_name.php';

    // Totals
    $total_prof = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM account_information WHERE position='teacher'")->fetchColumn();
    $total_students = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM student")->fetchColumn();
    $total_users = $total_prof + $total_students;

    $student = 'student';

    // Fetch login_act table and student table
    $stmt = $pdo->prepare("SELECT accountID, firstname, middlename, lastname, sex, position, dateAdded FROM account_information WHERE position='teacher'
                          UNION ALL
                          SELECT studentNumber, firstname, middlename, lastname, studentGender, :student, dateAdded FROM $student");
    $stmt->bindParam(':student', $student, PDO::PARAM_STR);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    

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

    <div class="sort-menu-report">
        <div class="date-container">
            <div class="datefrom">
                <label for="Date From">Date From</label>
                <input type="date">
            </div>
            <div class="dateto">
                <label for="Date To">Date To</label>
                <input type="date">
            </div>
            <button>Sort</button>
        </div>
    </div>

    <section class="main-container-recents-report">
        <div class="recent-registered">
            <div class="header-with-button">
                <p class="header-activity">Total Users: <?php echo $total_users?></p>
                <div class="buttons">
                    <button class="pdfRed"><i class="fa-regular fa-file-pdf"></i></button>
                    <button class="csvGreen"><i class="fa-solid fa-file-csv"></i></button>
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
            <?php foreach($users as $user){ ?>
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