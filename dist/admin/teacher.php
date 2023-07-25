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
    <title>Teacher | Admin</title>
</head>
<body>
    <!-- Topbar -->
    <?php include_once '../navbar/topbar.php'?>
    <!-- Sidebar -->
    <?php include_once '../navbar/sidebar.php'?>

    <!-- Main Container -->
    <div class="teacher-main-container">
        <div class="header">
            <h3>List of Registered Teacher</h3>
            <label for="header">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae, minima.</label>
        </div>
        
        <button class="addTeacher" onclick="openModalAddTeacher()">Add New</button>

        <div class="table-container teacher-table">
            <table>
                <tr>
                    <th>Employee ID</th>
                    <th>Teacher Name</th>
                    <th>Status</th>
                    <th>Option</th>
                </tr>
                <tr>
                    <td>201912344</td>
                    <td>Prof. Maribelle Atienza</td>
                    <td>active</td>
                    <td>
                        <button class="view" onclick="openModalViewTeacher()">View</button>
                        <button class="edit" onclick="openModalEditTeacher()">Edit</button>
                        <button class="archive">Deactivate</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Modal Container -->
    <?php include_once './modal/addTeacher.php'?>
</body>

<!-- Script Link -->
<script src="../js/modal.js"></script>
<script src="../js/alert.js"></script>
</html>