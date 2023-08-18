<?php
    session_start();
    include '../../connection/db_conn.php';
    include '../../connection/session.php';
    include '../../connection/session_name.php';

    $announceID = $_GET['id'];
    if(isset($_GET['view'])){
        $disable = 'disabled';
        $hideEdit = 'hide';
        $hideView ='';
    } else{
        $disable = '';
        $hideEdit = '';
        $hideView ='hide';
    }

    // User Detail
    $stmt = $pdo->prepare("SELECT * FROM announcement WHERE announceID = :announceID");
    $stmt->bindParam(':announceID', $announceID, PDO::PARAM_INT);
    $stmt->execute();
    $announce = $stmt->fetch(PDO::FETCH_ASSOC);

    // Date Format
    $date = new DateTime($announce['date']);
    $formattedDate = $date->format('M d, Y');
    // Time Format
    $time = new DateTime($announce['time']);
    $formattedTime = $time->format('g:i A');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../../connection/link.php'?>
    <title>Announcement</title>
</head>
<body>
    <!-- Topbar -->
    <?php include_once '../../navbar/topbar.php'?>
    <!-- Sidebar -->
    <?php include_once '../../navbar/sidebar.php'?>

    <br>
    <form action="../queries/teacher-query.php" method="post">
    <section class="announce-main-container">
        <div class="announce-content-box">
            <div class="circle-design">
                <p class="circle-green"></p>
                <p class="circle-green"></p>
                <p class="circle-green"></p>
            </div>

            <div class="header-content">
                <div class="imgHeader">
                    <p class="adminInitial">A</p>
                    <div class="text-content-topic">
                        <p><?php echo $formattedDate.' '.$formattedTime?></p>
                        <p>Subject: 
                            <span class="<?php echo $hideView?>"><?php echo $announce['subject']?></span>
                            <input type="text" name="subject" class="<?php echo $hideEdit?>" value="<?php echo $announce['subject']?>">
                        </p>
                        <p>admin</p>
                    </div>
                    
                </div>
                <button type="button" class="<?php echo $hideView?> edit"><a href="./announce-content.php?header=Announcement&id=<?php echo $announce['announceID']?>&edit">Edit</a></button>
            </div>
            
            <br><hr><br>
            <textarea name="description" id="" <?php echo $disable?> cols="30" rows="10"><?php echo $announce['description']?></textarea>
            <br>
            <input type="hidden" name="announceID" value="<?php echo $announce['announceID']?>">
            <button type="submit" name="updateAnnounce" class="<?php echo $hideEdit?>" id="saveChange">Save Changes</button>
        </div>
    </section>
    </form>
</body>
</html>