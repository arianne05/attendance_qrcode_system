<?php
    session_start();
    include '../connection/db_conn.php';
    include '../connection/session.php';
    include '../connection/session_name.php';

    // ANNOUNCEMENT PREVIEW
    $stmt = $pdo->prepare("SELECT * FROM announcement WHERE status='' ORDER BY date DESC, time DESC");
    $stmt->execute();
    $fetchAnnouncement = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../connection/link.php'?>
    <title>Annoucement</title>
</head>
<body>
    <!-- Topbar -->
    <?php include_once '../navbar/topbar.php'?>
    <!-- Sidebar -->
    <?php include_once '../navbar/sidebar.php'?>

    <br>
    <section class="announce-main-container">
        <?php foreach($fetchAnnouncement as $announce){
            // Date Format
            $date = new DateTime($announce['date']);
            $formattedDate = $date->format('M d, Y');
            // Time Format
            $time = new DateTime($announce['time']);
            $formattedTime = $time->format('g:i A');
        ?>
        <div class="announce-preview-box">
            <div class="adminInitial">
                <p>A</p>
            </div>
            <a href="../admin/profile/announce-content.php?header=Announcement&id=<?php echo $announce['announceID']?>&view" class="topic-preview">
                <div class="header-announce">
                    <p><?php echo $formattedDate.' '.$formattedTime?></p>
                    <h3><?php echo $announce['subject']?></h3>
                </div>
            </a>
            <div class="options">
                    <button type="button" class="activeRed" onclick="removeAnnounce(<?php echo $announce['announceID']; ?>)">Remove</button>
            </div>
        </div>
        <br>
        <?php }?>
    </section>
</body>
<script>
    // Deact Alert
    function removeAnnounce(announceID) {
        Swal.fire({
            icon: "question",
            title: "Remove",
            text: "Are you sure you want to remove this announcement?",
            showCancelButton: true,
        }).then(function (result) {
            if (result.isConfirmed) {
                // Redirect to the PHP script with the accountID parameter
                window.location.href = `./queries/teacher-query.php?removeAnnounce&id=${announceID}`;
            }
        });
    }
</script>
</html>