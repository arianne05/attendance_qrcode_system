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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Links -->
    <link rel="stylesheet" href="../css/main.css">
    <script src="https://kit.fontawesome.com/8b614ed6c5.js" crossorigin="anonymous"></script>
    <!-- Sweet Alert -->
    <script src="../js/sweetalert.min.js"></script>
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