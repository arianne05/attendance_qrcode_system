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
                    <li class="activeProfile"><a href="#">My Profile</a></li>
                    <li><a href="./user-profile-security.php?header=My Profile">Security</a></li>
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
                    <p><b>Personal Information</b></p>
                    <br>
                    <table>
                        <tr>
                            <td><span>Firstname</span> <br>Arianne</td>
                            <td><span>Middlename</span> <br>Hernandez</td>
                            <td><span>Lastname</span> <br>Quimpo</td>
                        </tr>
                        <tr>
                            <td><span>Username</span> <br>Aya2t05</td>
                            <td><span>Department</span> <br>English</td>
                            <td><span>Date Added</span> <br>Aug 1, 2023</td>
                        </tr>
                    </table>
                       
                </div>
            </div>
        </div>
    </div>
    </section>
</body>
</html>