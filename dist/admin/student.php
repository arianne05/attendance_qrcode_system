<?php
    session_start();
    include '../connection/db_conn.php';
    include '../connection/session.php';
    include '../connection/session_name.php';

    // FOR TABLE
    $stmt = $pdo->prepare("SELECT * FROM student");
    $stmt->execute();
    $student = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            <label for="header">Listed here are registered student account  .</label>
        </div>

        <button class="addTeacher" onclick="openModalAddStudent()">Add New</button>

        <div class="table-container teacher-table">
            <table id="student" class="display">
                <thead>
                    <tr>
                        <th>Student No.</th>
                        <th>Student Name</th>
                        <th>Grade/Section</th>
                        <th>School Year</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($student as $student){ ?>
                    <tr>
                        <td><?php echo $student['studentNumber']?></td>
                        <td class="name"><a href="#" onclick="openModalViewStudent(<?php echo $student['studentID']; ?>)"><?php echo $student['firstname'].' '.$student['middlename'].' '.$student['lastname']?></a></td>
                        <td><?php echo $student['studentSection']?></td>
                        <td><?php echo $student['studentYear']?></td>
                        <td>
                            <button class="view">Detail</button>
                            <button class="edit" onclick="openModalEditStudent()">Edit</button>
                            <button class="archive">Archive</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Container -->
    <?php include_once './modal/student-modal.php'?>
</body>

<!-- Script Link -->
<script src="../js/modal.js"></script>
<script src="../js/alert.js"></script>
<script>    
    new DataTable('#student');
</script>
</html>