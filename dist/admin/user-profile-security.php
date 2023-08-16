<?php
    session_start();
    include '../connection/db_conn.php';
    include '../connection/session.php';
    include '../connection/session_name.php';

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
                    <li><a href="./user-profile.php?header=My Profile">My Profile</a></li>
                    <li class="activeProfile"><a href="#">Security</a></li>
                    <li><a href="./user-profile-announ.php?header=My Profile">Announcement</a></li>
                </ul>
            </div>

            <div class="right-profile-container">
                <div class="profile-overview">
                    <div class="img-container">
                        <img src="../img/user-icon-default/user-male-default.png" alt="">
                    </div>
                    <div class="name-container">
                        <div class="header-profile">
                            <p><b>Arianne Quimpo</b></p>
                            <p class="green-profile">admin</p>
                            <p class="gray-profile">#201912344</p>
                        </div>
                        <div class="edit-profile">
                            <button>Edit</button>
                        </div>
                    </div>
                </div>
                <br> 
                <!-- New Section -->
                <div class="profile-detail">
                    <p><b>Security Information</b></p>
                    <br>
                    <div class="text-security">
                        <label for="uname">Username</label>
                        <input type="text" value="Aya2t05">
                    </div>
                    <br>
                    <div class="text-security">
                        <label for="uname">Password</label>
                        <input type="password" value="Aya2t05">
                    </div>
                    <br>
                    <div class="text-security">
                        <label for="uname">Confirm Password</label>
                        <input type="password" value="Aya2t05">
                    </div>
                    <br><hr><br>
                    <p><b>Security Question</b></p>
                    <br>
                    <div class="text-security">
                        <label for="uname">Questions</label>
                        <select name="" id="">
                            <option selected disabled>Select Security Question</option>
                            <option value="What is my birth month?">What is my birth month?</option>
                            <option value="What is my favorite dessert?">What is my favorite dessert?</option>
                            <option value="Who is my favorite singer?">Who is my favorite singer?</option>
                            <option value="Where do I live?">Where do I live?</option>
                        </select>
                    </div>
                    <br>
                    <div class="text-security">
                        <label for="uname">Answer</label>
                        <input type="text" value="Answer">
                    </div>
                    <br>
                    <button class="saveChanges">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
    </section>
</body>
</html>