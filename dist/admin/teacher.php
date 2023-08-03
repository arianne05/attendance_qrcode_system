<?php
    session_start();
    include '../connection/db_conn.php';
    include '../connection/session.php';

    // FOR VIEW
    $stmt = $pdo->prepare("SELECT * FROM account_information WHERE position ='teacher'");
    $stmt->execute();
    $teacher = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
            <label for="header">Listed here are the registered accounts of the teacher.</label>
        </div>
        
        <button class="addTeacher" onclick="openModalAddTeacher()">Add New</button>

        <div class="table-container teacher-table">
            <table id="example" class="display">
                <thead>
                    <tr>
                        <th class="centerHead">Employee ID</th>
                        <th class="centerHead">Teacher Name</th>
                        <th class="centerHead">Status</th>
                        <th class="centerHead">Option</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($teacher as $teacher){ 
                        if ($teacher['status'] == 'active'){
                            $colorStatus = 'activeGreen';
                            $changeBtn = 'Deactivate';
                            $alert = 'deactivateAlert';
                        }else{
                            $colorStatus = 'activeRed';
                            $changeBtn = 'Activate';
                            $alert = 'activateAlert';
                        }
                    ?>
                    <tr>
                        <td><?php echo $teacher['accountID']?></td>
                        <td class="name"><a href="#" onclick="openModalViewTeacher(<?php echo $teacher['accountID']; ?>)"><?php echo $teacher['firstname'].' '.$teacher['middlename'].' '.$teacher['lastname']?></a></td>
                        <td class="<?php echo $colorStatus?>"><?php echo $teacher['status']?></td>
                        <td>
                            <!-- Detail -->
                            <a href="./profile/teacher-view.php?header=<?php echo $teacher['firstname']?>'s Profile&id=<?php echo $teacher['accountID']?>">
                                <button class="view">Detail</button>
                            </a>
                            <!-- Edit -->
                            <a href="./edit/teacher-edit.php?header=Teacher&id=<?php echo $teacher['accountID']?>">
                                <button class="edit">Edit</button>
                            </a>
                            <!-- Deactivate -->
                            <button type="button" class="archive" onclick="<?php echo $alert?>('<?php echo $teacher['accountID']; ?>')"><?php echo $changeBtn?></button>

                            <!-- Add a hidden input field to store the accountID -->
                            <input type="hidden" class="accountID" value="<?php echo $teacher['accountID']; ?>">
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
                
            </table>
        </div>
    </div>

    <!-- Modal Container -->
    <?php include_once './modal/teacher-modal.php'?>
</body>

<!-- Script Link -->
<script src="../js/modal.js"></script>
<script src="../js/alert.js"></script>
<script src="../js/addInputType.js"></script>
<script>    
    new DataTable('#example');
</script>
<!-- Sweet Alert Deactivate -->
<script>
    // Deact Alert
    function deactivateAlert(accountID) {
        Swal.fire({
            icon: "question",
            title: "Deactivate",
            text: "Are you sure you want to deactivate this account?",
            showCancelButton: true,
        }).then(function (result) {
            if (result.isConfirmed) {
                // Redirect to the PHP script with the accountID parameter
                window.location.href = `./queries/teacher-query.php?deactivate&id=${accountID}`;
            }
        });
    }
</script>
<script>
    // Active Alert
    function activateAlert(accountID) {
        Swal.fire({
            icon: "question",
            title: "Activate",
            text: "Are you sure you want to activate this account?",
            showCancelButton: true,
        }).then(function (result) {
            if (result.isConfirmed) {
                // Redirect to the PHP script with the accountID parameter
                window.location.href = `./queries/teacher-query.php?activate&id=${accountID}`;
            }
        });
    }
</script>

</html>