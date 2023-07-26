<?php
    session_start();
    include '../connection/db_conn.php';
    include '../connection/session.php';

    $stmt = $pdo->prepare("SELECT * FROM account_information WHERE position ='teacher'");
    $stmt->execute();
    $teacher = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $viewTeacher = $pdo->query("SELECT * FROM account_information WHERE position = 'teacher'")->fetchAll();
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
                <?php foreach($teacher as $teacher){ ?>
                <tr>
                    <td><?php echo $teacher['accountID']?></td>
                    <td><?php echo $teacher['firstname'].' '.$teacher['middlename'].' '.$teacher['lastname']?></td>
                    <td><?php echo $teacher['status']?></td>
                    <td>
                        <button class="view" onclick="openModalViewTeacher(<?php echo $teacher['accountID']; ?>)">View</button>
                        <button class="edit" onclick="openModalEditTeacher()">Edit</button>
                        <button class="archive">Deactivate</button>
                        <!-- Add a hidden input field to store the accountID -->
                        <input type="hidden" class="accountID" value="<?php echo $teacher['accountID']; ?>">
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>

    <!-- Modal Container -->
    <?php include_once './modal/addTeacher.php'?>
</body>

<!-- Script Link -->
<script src="../js/modal.js"></script>
<script src="../js/alert.js"></script>
<script src="../js/addInputType.js"></script>
</html>