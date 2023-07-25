<?php
    session_start();
    include '../connection/db_conn.php';
    include '../connection/session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../connection/link.php'?>
    <title>Student | Admin</title>
</head>
<body>
    <!-- Topbar -->
    <?php include_once '../navbar/topbar.php'?>
    <!-- Sidebar -->
    <?php include_once '../navbar/sidebar.php'?>

    <div class="student-main-container">
        <div class="header">
            <h3>List of Registered Student</h3>
            <label for="header">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae, minima.</label>
        </div>

        <button class="addTeacher" onclick="openModalAddStudent()">Add New</button>

        <div class="table-container teacher-table">
            <table>
                <tr>
                    <th>Student No.</th>
                    <th>Student Name</th>
                    <th>Grade/Section</th>
                    <th>School Year</th>
                    <th>Option</th>
                </tr>
                <tr>
                    <td>201912344</td>
                    <td>Arianne Quimpo</td>
                    <td>G10 Malbar</td>
                    <td>2020-2023</td>
                    <td>
                        <button class="view" onclick="openModalViewStudent()">View</button>
                        <button class="edit" onclick="openModalEditStudent()">Edit</button>
                        <button class="archive">Archive</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Modal Container -->
    <?php include_once './modal/addStudent.php'?>
</body>

<!-- Script Link -->
<script src="../js/modal.js"></script>
<script src="../js/alert.js"></script>
</html>