<?php
    session_start();
    include '../connection/db_conn.php';
    include '../connection/session.php';

    $accountID=$_SESSION['accountID'];
    $infoUser = $pdo->query("SELECT * FROM account_information WHERE accountID = '$accountID' AND position = 'teacher'")->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../css/main.css"> -->
    <?php include_once '../connection/link.php';?>
    <title>Document</title>
</head>
<body>
    <?php include_once '../navbar/topbar-teacher.php';?>
    <?php include_once '../navbar/sidebar-teacher.php';?>

    <section class="dashboard-teacher-main-container">
        <div class="main-body-content">
            <div class="total-section-teacher">
                <h1>250</h1>
                <div class="school-name">
                    <p>Governor Ferrer Memorial National Highschool</p>
                    <p><span class="school-label">Total Students</span></p>
                </div>
                <button>View Report</button>
            </div>

            <div class="total-category">
                <div class="per-category">
                    <div class="category">
                        <div class="male-img">
                            <img src="../img/male-icon.png" alt="">
                        </div>
                        <div class="male-caption">
                            <h1>34 <span>total</span></h1>
                            <p>Male Student</p>
                        </div>
                    </div>
                    <div class="category">
                        <div class="female-img">
                            <img src="../img/female-icon.png" alt="">
                        </div>
                        <div class="female-caption">
                            <h1>34 <span>total</span></h1>
                            <p>Female Student</p>
                        </div>
                    </div>
                    <div class="category">
                        <div class="prof-img">
                            <img src="../img/prof-icon.png" alt="">
                        </div>
                        <div class="prof-caption">
                            <h1>34 <span>total</span></h1>
                            <p>Professors</p>
                        </div>
                    </div>
                </div>
                <div class="table-category">
                    <table>
                        <thead>
                            <tr>
                                <th>Section</th>
                                <th>Total Student</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Sampaguita</td>
                                <td>51</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                
            </div>
        </div>

        <!-- right content -->
        <div class="right-content">
            <!-- Time and Calendar -->
            <p>Today</p>
            <div class="time-calendar">
                <div id="clock">
                    <span class="time"></span>
                    <span class="day"></span>
                </div>
                <div class="calendar-container">
                    <div id="calendar"></div>
                </div>
                <div class="button-calendar">
                    <button id="prevBtn"><i class="fa-solid fa-chevron-left"></i></button>
                    <button id="nextBtn"><i class="fa-solid fa-chevron-right"></i></i></button>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="../js/calendar.js"></script>
<script src="../js/time.js"></script>
</html>