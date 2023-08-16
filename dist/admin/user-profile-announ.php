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
                    <li><a href="./user-profile-security.php?header=My Profile">Security</a></li>
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
                    <p><b>Create Announcement</b></p>
                    <br>
                    <div class="text-security">
                        <label for="uname">Subject</label>
                        <input type="text" value="Aya2t05">
                    </div>
                    <br>
                    <div class="text-security">
                        <label for="uname">Description</label>
                        <textarea name="" id="" cols="30" rows="10"></textarea>
                    </div>
                    <br>
                    <button class="saveChanges">Send Announcement</button>
                </div>
            </div>
        </div>
    </div>
    </section>
</body>
</html>