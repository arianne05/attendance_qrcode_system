<?php
    session_start();
    include '../connection/db_conn.php';
    include '../connection/session.php';
    include '../connection/session_name.php';

    $accountID = $_GET['id'];
    // User Detail
    $stmt = $pdo->prepare("SELECT * FROM account_information WHERE accountID = :accountID");
    $stmt->bindParam(':accountID', $accountID, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../connection/link.php'?>
    <title>My Profile</title>
</head>
<body>
    <!-- Topbar -->
    <?php include_once '../navbar/topbar.php'?>
    <!-- Sidebar -->
    <?php include_once '../navbar/sidebar.php'?>

    <section class="my-container">
        <br><h3>Account Setting</h3><br>
        <div class="main-profile-container">
            <div class="left-profile-container">
                <ul>
                    <li><a href="./user-profile.php?header=My Profile&id=<?php echo $user['accountID']?>">My Profile</a></li>
                    <li><a href="./user-profile-security.php?header=My Profile&id=<?php echo $user['accountID']?>">Security</a></li>
                    <li class="activeProfile"><a href="#">Announcement</a></li>
                </ul>
            </div>

            <div class="right-profile-container">
                <div class="profile-overview">
                    <div class="img-container">
                        <img src="../img/user-icon-default/user-male-default.png" alt="">
                    </div>
                    <div class="name-container">
                        <div class="header-profile">
                            <p><b><?php echo $user['firstname'].' '.$user['lastname']?></b></p>
                            <p class="green-profile"><?php echo $user['position']?></p>
                            <p class="gray-profile">#<?php echo $user['accountID']?></p>
                        </div>
                        <div class="edit-profile">
                            <a href="./user-profile.php?header=My Profile&id=<?php echo $user['accountID']?>&editProfile"><button>Edit</button></a>
                        </div>
                    </div>
                </div>
                <br> 
                <!-- New Section -->
                <form action="./queries/teacher-query.php" method="post">
                <div class="profile-detail">
                    <p><b>Create Announcement</b></p>
                    <br>
                    <div class="text-security">
                        <label for="uname">Subject</label>
                        <input type="text" name="subject" placeholder="Indicate Topic">
                        <input type="hidden" name="accountID" value="<?php echo $accountID?>">
                    </div>
                    <br>
                    <div class="text-security">
                        <label for="uname">Description</label>
                        <textarea name="description" placeholder="Describe your context"></textarea>
                    </div>
                    <br>
                    <button class="saveChanges" name="addAnnounce">Send Announcement</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </section>
</body>
</html>