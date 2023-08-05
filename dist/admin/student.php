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
                    <?php foreach($student as $student){ 
                        if ($student['status'] == ''){
                            $colorStatus = 'activeRed';
                            $changeBtn = 'Remove';
                            $alert = 'removeAlert';
                        }else{
                            $colorStatus = 'activeGreen';
                            $changeBtn = 'Restore';
                            $alert = 'restoreAlert';
                        }
                    ?>
                    <tr>
                        <td><?php echo $student['studentNumber']?></td>
                        <td class="name"><a href="#" onclick="openModalViewStudent(<?php echo $student['studentID']; ?>)"><?php echo $student['firstname'].' '.$student['middlename'].' '.$student['lastname']?></a></td>
                        <td><?php echo $student['studentSection']?></td>
                        <td><?php echo $student['studentYear']?></td>
                        <td>
                            <!-- Detail -->
                            <a href="./profile/student-view.php?header=<?php echo $student['firstname']?>'s Profile&id=<?php echo $student['studentID']?>&studNum=<?php echo $student['studentNumber']?>">
                                <button class="view">Detail</button>
                            </a>
                            <!-- Edit -->
                            <a href="./edit/student-edit.php?header=Student&id=<?php echo $student['studentNumber']?>">
                                <button class="edit">Edit</button>
                            </a>
                            <!-- Deactivate -->
                            <button type="button" class="<?php echo $colorStatus;?>" onclick="<?php echo $alert?>('<?php echo $student['studentID']; ?>')"><?php echo $changeBtn?></button>
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

<!-- Sweet Alert Removed -->
<script>
    // Removes Alert
    function removeAlert(studentID) {
        Swal.fire({
            icon: "question",
            title: "Deactivate",
            text: "Are you sure you want to remove this account?",
            showCancelButton: true,
        }).then(function (result) {
            if (result.isConfirmed) {
                // Redirect to the PHP script with the accountID parameter
                window.location.href = `./queries/student-query.php?remove&id=${studentID}`;
            }
        });
    }
</script>
<script>
    // Active Alert
    function restoreAlert(studentID) {
        Swal.fire({
            icon: "question",
            title: "Activate",
            text: "Are you sure you want to restore this account?",
            showCancelButton: true,
        }).then(function (result) {
            if (result.isConfirmed) {
                // Redirect to the PHP script with the accountID parameter
                window.location.href = `./queries/student-query.php?restore&id=${studentID}`;
            }
        });
    }
</script>

</html>