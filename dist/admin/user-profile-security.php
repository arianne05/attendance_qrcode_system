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
                    <li class="activeProfile"><a href="#">Security</a></li>
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
                <!-- New Section -->
                <form action="./queries/teacher-query.php" method="post">
                <div class="profile-detail">
                    <p><b>Security Information</b></p>
                    <br>
                    <div class="text-security">
                        <label for="uname">Username</label>
                        <input type="text" name="username" value="<?php echo $user['username']?>">
                    </div>
                    <br>
                    <div class="text-security">
                        <label for="uname">Password</label>
                        <input type="password" name="password" value="<?php echo $user['password']?>">
                    </div>
                    <br>
                    <div class="text-security">
                        <label for="uname">Confirm Password</label>
                        <input type="password" name="cpassword" placeholder="Re-type your password here">
                    </div>
                    <br><hr><br>
                    <p><b>Security Question</b></p>
                    <br>
                    <div class="text-security">
                        <label for="uname">Questions</label>
                        <select name="secQuestion">
                            <option selected disabled>Select Security Question</option>
                            <option value="What is my birth month?" <?php echo ($user['secQuestion'] == 'What is my birth month?') ? 'selected' : ''; ?>>What is my birth month?</option>
                            <option value="What is my favorite dessert?" <?php echo ($user['secQuestion'] == 'What is my favorite dessert?') ? 'selected' : ''; ?>>What is my favorite dessert?</option>
                            <option value="Who is my favorite singer?" <?php echo ($user['secQuestion'] == 'Who is my favorite singer?') ? 'selected' : ''; ?>>Who is my favorite singer?</option>
                            <option value="Where do I live?" <?php echo ($user['secQuestion'] == 'Where do I live?') ? 'selected' : ''; ?>>Where do I live?</option>
                        </select>
                    </div>
                    <br>
                    <div class="text-security">
                        <label for="uname">Answer</label>
                        <input type="text" name="secAnswer" value="<?php echo $user['secAnswer']?>" placeholder="Type your answer here">
                        <input type="hidden" name="accountID" value="<?php echo $user['accountID']?>">
                    </div>
                    <br>
                    <button class="saveChanges" name="saveSecurity">Save Changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </section>
</body>
</html>