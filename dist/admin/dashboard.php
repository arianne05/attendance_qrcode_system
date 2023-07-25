<?php
    session_start();
    include '../connection/db_conn.php';
    include '../connection/session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../connection/link.php'?>
    <title>Dashboard</title>
</head>
<body>
    <!-- Sweet Alert -->
    <?php include_once '../connection/alert.php'?>

    <!-- Topbar -->
    <?php include_once '../navbar/topbar.php'?>

    <div class="dashboard-main-content">
        <!-- Sidebar -->
        <?php include_once '../navbar/sidebar.php'?>

          <section class="dashboard-content">
            <p>Overview</p>
            <div class="overview-section">
                <div class="total-record-section">
                    <h1>250</h1>
                    <div class="school-name">
                        <p>Governor Ferrer Memorial National Highschool</p>
                        <p><span class="school-label">Total Number of Students</span></p>
                    </div>
                    
                    <button>View Report</button>
                </div>
                
                <div class="total-per-category">
                    <div class="image-left">
                        <img src="../img/dashboard-image.png" width="277" alt="">
                    </div>
                    <div class="text-right">
                        <div class="male-student">
                            <div class="male-img">
                                <img src="../img/male-icon.png" alt="">
                            </div>
                            <div class="male-caption">
                                <h1>34 <span>total</span></h1>
                                <p>Male Student</p>
                            </div>
                        </div>
                        <div class="female-student">
                            <div class="female-img">
                                <img src="../img/female-icon.png" alt="">
                            </div>
                            <div class="female-caption">
                                <h1>34 <span>total</span></h1>
                                <p>Female Student</p>
                            </div>
                        </div>
                        <div class="prof">
                            <div class="prof-img">
                                <img src="../img/prof-icon.png" alt="">
                            </div>
                            <div class="prof-caption">
                                <h1>34 <span>total</span></h1>
                            <p>Professors</p>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table section -->
            <div class="table-header">
                <p>Latest Added</p>
                <div class="sort-latest">
                    <i class="fa-solid fa-calendar-days"></i>
                    <select name="" id="">
                        <option value="">Today</option>
                    </select>
                </div>
            </div>
            
            <!-- Table -->
            <div class="table-main-dashboard">
                <div class="circle-design">
                    <p class="circle-green"></p>
                    <p class="circle-green"></p>
                    <p class="circle-green"></p>
                </div>
                <table class="table-dashboard">
                    <tr>
                        <th>Student Name</th>
                        <th>Time-in</th>
                        <th>Professor</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td>Arianne H. Quimpo</td>
                        <td>11:00 AM</td>
                        <td>Prof. Elrich Lanuza</td>
                        <td class="status-dashboard">on-time</td>
                        <td><a href="#">Details</a></td>
                    </tr>
                </table>
            </div>
          </section>

          <section class="dashboard-content-right">
                <p>Today</p>
                <!-- Time and Calendar -->
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
                
                <!-- Users display -->
                <div class="faculty-member-main">
                    <p>Faculty Members</p>
                    <div class="members-circle">
                        <p>AQ</p>
                        <p>EL</p>
                        <p>RC</p>
                        <p>KL</p>
                        <p>KL</p>
                        <p class="add-user"><span>+</span></p>
                    </div>
                    <div class="header-filter">
                        <p>Recent Activity</p>
                        <i class="fa-solid fa-arrow-down-wide-short"></i>
                    </div>
                    <div class="recents-activity">
                        <div class="circle-activity">
                            <p class="circle-user-recent">AQ</p>
                        </div>
                        <div class="text-activity">
                            <div class="description-activity">
                                <p class="time-user-activity">10:05 AM Feb 27, 2023</p>
                                <p class="desc-user-activity">Arianne Quimpo added Elrich Lanuza</p>
                            </div>
                        </div>
                    </div>
                    <div class="recents-activity">
                        <div class="circle-activity">
                            <p class="circle-user-recent">AQ</p>
                        </div>
                        <div class="text-activity">
                            <div class="description-activity">
                                <p class="time-user-activity">10:05 AM Feb 27, 2023</p>
                                <p class="desc-user-activity">Arianne Quimpo added Elrich Lanuza</p>
                            </div>
                        </div>
                    </div>
                    <div class="recents-activity">
                        <div class="circle-activity">
                            <p class="circle-user-recent">AQ</p>
                        </div>
                        <div class="text-activity">
                            <div class="description-activity">
                                <p class="time-user-activity">10:05 AM Feb 27, 2023</p>
                                <p class="desc-user-activity">Arianne Quimpo added Elrich Lanuza</p>
                            </div>
                        </div>
                    </div>
                    <div class="recents-activity">
                        <div class="circle-activity">
                            <p class="circle-user-recent">AQ</p>
                        </div>
                        <div class="text-activity">
                            <div class="description-activity">
                                <p class="time-user-activity">10:05 AM Feb 27, 2023</p>
                                <p class="desc-user-activity">Arianne Quimpo added Elrich Lanuza</p>
                            </div>
                        </div>
                    </div>
                    <p class="view-more">View More</p>
                </div>
          </section>
    </div>
</body>
    <!-- JS links -->
    <script src="../js/calendar.js"></script>
    <script src="../js/time.js"></script>
    <script src="../js/alert.js"></script>
</html>