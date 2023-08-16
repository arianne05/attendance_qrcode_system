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

    // Date Format
    $date = new DateTime($user['dateAdded']);
    $formattedDate = $date->format('M d, Y');

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
                    <li class="activeProfile"><a href="./user-profile.php?header=My Profile&id=<?php echo $user['accountID']?>">My Profile</a></li>
                    <li><a href="./user-profile-security.php?header=My Profile&id=<?php echo $user['accountID']?>">Security</a></li>
                    <li><a href="./user-profile-announ.php?header=My Profile&id=<?php echo $user['accountID']?>">Announcement</a></li>
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
                <?php 
                    if(isset($_GET['editProfile'])){
                        $tableEdit='display';
                        $tableView='nodisplay';
                    }else{
                        $tableEdit='nodisplay';
                        $tableView='display';;
                    }
                ?>
                <!-- New Section -->
                <form action="./queries/teacher-query.php" method="post">
                <div class="profile-detail">
                    <p><b>Personal Information</b></p>
                    <br>
                    <table>
                        <tr class="<?php echo $tableView?>">
                            <td><span>Firstname</span> <br><?php echo $user['firstname']?></td>
                            <td><span>Middlename</span> <br><?php echo !empty($user['middlename']) ? $user['middlename'] : 'N/A'; ?></td>
                            <td><span>Lastname</span> <br><?php echo $user['lastname']?></td>
                        </tr>
                        <tr class="<?php echo $tableView?>">
                            <td><span>Username</span> <br><?php echo $user['username']?></td>
                            <td><span>Department</span> <br><?php echo !empty($user['faculty']) ? $user['faculty'] : 'N/A'; ?></td>
                            <td><span>Date Added</span> <br><?php echo $formattedDate?></td>
                        </tr>
                        <tr class="<?php echo $tableEdit?>">
                            <td><span>Firstname</span> <br><input type="text" name="firstname" value="<?php echo $user['firstname']?>"></td>
                            <td><span>Middlename</span> <br><input type="text" name="middlename" value="<?php echo $user['middlename']; ?>"></td>
                            <td><span>Lastname</span> <br><input type="text" name="lastname" value="<?php echo $user['lastname']?>"></td>
                        </tr>
                        <tr class="<?php echo $tableEdit?>">
                            <td><span>Username</span><br><input type="text" name="username" value="<?php echo $user['username']?>"></td>
                            <td><span>Department</span> <br><input type="text" name="faculty" value="<?php echo $user['faculty']?>"></td>
                            <td><span>Date Added</span> <br><input type="date" name="dateAdded" value="<?php echo $user['dateAdded']?>"></td>
                        </tr>
                    </table>
                    <input type="hidden" value="<?php echo $accountID?>" name="accountID">
                    <button class="<?php echo $tableEdit?>" name="updateProfile">Save Changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </section>
</body>
</html>