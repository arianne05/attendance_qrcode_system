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
            <label for="header">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae, minima.</label>
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
                    <?php foreach($teacher as $teacher){ ?>
                    <tr>
                        <td><?php echo $teacher['accountID']?></td>
                        <td class="name"><?php echo $teacher['firstname'].' '.$teacher['middlename'].' '.$teacher['lastname']?></td>
                        <td><?php echo $teacher['status']?></td>
                        <td>
                            <button class="view" onclick="openModalViewTeacher(<?php echo $teacher['accountID']; ?>)">View</button>
                            <button class="edit"><a href="./edit/teacher-edit.php?header=Teacher&id=<?php echo $teacher['accountID']?>">Edit</a></button>

                            <!-- Add a hidden input field to store the accountID -->
                            <input type="hidden" class="accountID" value="<?php echo $teacher['accountID']; ?>">
                            <!-- <button type="submit" class="archive" onclick="deactivateAlert()">Deactivate</button> -->
                            <button type="button" class="archive" onclick="deactivateAlert('<?php echo $teacher['accountID']; ?>')">Deactivate</button>

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

</html>