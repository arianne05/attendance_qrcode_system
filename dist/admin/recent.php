<?php
    session_start();
    include '../connection/db_conn.php';
    include '../connection/session.php';
    include '../connection/session_name.php';

     // Totals
     $totalAdded = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM recents WHERE recentLabel='added'")->fetchColumn();
     $totalEdited = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM recents WHERE recentLabel='edited'")->fetchColumn();
     $totalArchived = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM recents WHERE recentLabel='archived'")->fetchColumn();

    // Fetch recents table
    $stmt = $pdo->prepare("SELECT * FROM recents");
    $stmt->execute();
    $recent = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Fetch account teacher table
    $stmt = $pdo->prepare("SELECT * FROM account_information WHERE position='teacher'");
    $stmt->execute();
    $teacher = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../connection/link.php'?>
    <title>Recent | Admin</title>
</head>
<body>
    <!-- Topbar -->
    <?php include_once '../navbar/topbar.php'?>
    <!-- Sidebar -->
    <?php include_once '../navbar/sidebar.php'?>

    <!-- Recent Body -->
    <div class="recent-main-container">
        <div class="recent-main-header">
            <h3>Recent Activities</h5>
            <p>List of recent changes made in the system by the user.</p>

            <!-- Middle Section -->
            <div class="table-container">
                <table id="recentsTbl" class="display">
                    <thead>
                        <tr>
                            <th>Professor Name</th>
                            <th>Action</th>
                            <th>Student Name</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <?php foreach($recent as $getRecent){
                        $accountID = $getRecent['accountID'];
                        $studentID = $getRecent['studentNumber'];
                        
                        // Date Format
                        $date = new DateTime($getRecent['recentDate']);
                        $formattedDate = $date->format('M d, Y');
                        // Time Format
                        $time = new DateTime($getRecent['recentTime']);
                        $formattedTime = $time->format('g:i A');

                        $dateTime = $formattedDate.' '.$formattedTime;

                        // Fetch account info table
                        $stmt = $pdo->prepare("SELECT * FROM account_information WHERE accountID = :accountID");
                        $stmt->bindParam(':accountID', $accountID, PDO::PARAM_INT);
                        $stmt->execute();
                        $fetchProf = $stmt->fetch(PDO::FETCH_ASSOC);
                        // Fetch student table
                        $stmt = $pdo->prepare("SELECT * FROM student WHERE studentNumber = :studentNumber");
                        $stmt->bindParam(':studentNumber', $studentID, PDO::PARAM_INT);
                        $stmt->execute();
                        $fetchStud = $stmt->fetch(PDO::FETCH_ASSOC);

                        $fullnameProf = $fetchProf['firstname'].' '.$fetchProf['middlename'].' '.$fetchProf['lastname'];
                        $fullnameStud = $fetchStud['firstname'].' '.$fetchStud['middlename'].' '.$fetchStud['lastname'];
                    
                        // Label Color Display
                        $label = $getRecent['recentLabel'];
                        if ($label == 'added'){
                            $classLabel = 'added';
                        } if ($label == 'edited'){
                            $classLabel = 'edited';
                        } if ($label == 'archived'){
                            $classLabel = 'archived';
                        }
                    ?>
                    <tbody>
                        <tr>
                            <td><?php echo $fullnameProf?></td>
                            <td><span class="<?php echo $classLabel?>"><?php echo $getRecent['recentLabel'];?></span></td>
                            <td><?php echo $fullnameStud?></td>
                            <td><?php echo $dateTime?></td>
                        </tr>
                    </tbody>
                    <?php } ?>
                </table>
            </div>
        </div>

        <!-- Right Section -->
        <div class="recent-faculty-member">
            <div class="user-activity">
                <h3>User Activity</h3>
                <div class="add-container">
                    <div class="label">
                        <p class="add"></p>
                        <p>Added</p>
                    </div>
                    <p><?php echo $totalAdded?></p>
                </div>
                <div class="edit-container">
                    <div class="label">
                        <p class="edit"></p>
                        <p>Edited</p>
                    </div>
                    <p><?php echo $totalEdited?></p>
                </div>
                <div class="archive-container">
                    <div class="label">
                        <p class="archive"></p>
                        <p>Archived</p>
                    </div>
                    <p><?php echo $totalArchived?></p>
                </div>
            </div>

            <div class="list-member">
                <h3>Faculty Member</h3>
                <?php foreach($teacher as $getTeacher){
                    $userInitials = substr($getTeacher['firstname'], 0, 1) . substr($getTeacher['lastname'], 0, 1);
                    $fullName = $getTeacher['firstname'] . ' ' . $getTeacher['lastname'];
                ?>
                <a href="./profile/teacher-view.php?header=<?php echo $getTeacher['firstname']?>'s Profile&id=<?php echo $getTeacher['accountID']?>" class="member-container">
                    <p class="circle-user-recent"><?php echo $userInitials?></p>
                    <p><?php echo $fullName?></p>
                </a>
                <?php }?>
            </div>
        </div>
    </div>
</body>
<!-- JS Link -->
<script src="../js/alert.js"></script>
<script>    
    new DataTable('#recentsTbl');
</script>
</html>