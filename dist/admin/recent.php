<?php
    session_start();
    include '../connection/db_conn.php';
    if (!isset($_SESSION['accountID'])) {
        // Redirect the user to the login page
        header("Location: ../index.php?errorSession");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../connection/link.php'?>
    <title>Recent | Admin</title>
</head>
<body>
    <!-- Topbar -->
    <?php include_once '../navbar/topbar.php'?>
    <!-- Sidebar -->
    <?php include_once '../navbar/sidebar.php'?>

    <!-- Recent Body -->
    <div class="recent-main-container">
        <div class="recent-main-header">
            <h3>Recent Activities</h5>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minima, architecto.</p>

            <!-- Table and Button -->
            <div class="sort-menu">
                <div class="date-container">
                    <div class="datefrom">
                        <label for="Date From">Date From</label>
                        <input type="date">
                    </div>
                    <div class="dateto">
                        <label for="Date To">Date To</label>
                        <input type="date">
                    </div>
                    <button>Sort</button>
                </div>
            </div>

            <!-- Middle Section -->
            <div class="table-container">
                <table>
                    <tr>
                        <th>Professor Name</th>
                        <th>Action</th>
                        <th>Student Name</th>
                        <th>Date</th>
                    </tr>
                    <tr>
                        <td>Arianne H. Quimpo</td>
                        <td>Added</td>
                        <td>Elrich Lanuza</td>
                        <td>10:04 AM Feb 23, 2023</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Right Section -->
        <div class="recent-faculty-member">
            <div class="user-activity">
                <h3>User Activity</h3>
                <div class="add-container">
                    <div class="label">
                        <p class="add"></p>
                        <p>Added</p>
                    </div>
                    <p>10</p>
                </div>
                <div class="edit-container">
                    <div class="label">
                        <p class="edit"></p>
                        <p>Edited</p>
                    </div>
                    <p>3</p>
                </div>
                <div class="archive-container">
                    <div class="label">
                        <p class="archive"></p>
                        <p>Archived</p>
                    </div>
                    <p>20</p>
                </div>
            </div>

            <div class="list-member">
                <h3>Faculty Member</h3>
                <div class="member-container">
                    <p class="circle-user-recent">AQ</p>
                    <p>Arianne Quimpo</p>
                </div>
                <div class="member-container">
                    <p class="circle-user-recent">EL</p>
                    <p>Elrich Lanuza</p>
                </div>
                <div class="member-container">
                    <p class="circle-user-recent">RC</p>
                    <p>Rens Campos</p>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- JS Link -->
<script src="../js/alert.js"></script>
</html>