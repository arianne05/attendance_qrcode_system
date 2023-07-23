<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <script src="https://kit.fontawesome.com/8b614ed6c5.js" crossorigin="anonymous"></script>
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

</html>