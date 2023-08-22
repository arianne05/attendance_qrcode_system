<?php
session_start();
include '../../connection/db_conn.php';
include '../../connection/session.php';
include '../../connection/session_name.php';

$accountID = $_GET['id'];
$status =  $pdo->query("SELECT * FROM account_information WHERE accountID = '$accountID' AND position = 'teacher'")->fetch();
// $editInfo = $pdo->query("SELECT * FROM account_information 
//         INNER JOIN teacher_handle ON account_information.accountID = teacher_handle.accountID
//         WHERE account_information.accountID = '$accountID' AND account_information.position = 'teacher'")->fetch();
$editInfo = $pdo->query("SELECT * FROM account_information 
        WHERE accountID = '$accountID' AND position = 'teacher'")->fetchAll();

$sectionHandle = $pdo->query("SELECT * FROM account_information 
        INNER JOIN teacher_handle ON account_information.accountID = teacher_handle.accountID
        WHERE account_information.accountID = '$accountID' AND account_information.position = 'teacher' GROUP BY schoolYear")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../../connection/link.php'?>
    <title>Admin | Detail</title>
</head>
<body>
    <!-- Topbar -->
    <?php include_once '../../navbar/topbar.php'?>
    <!-- Sidebar -->
    <?php include_once '../../navbar/sidebar.php'?>

    <div class="modal-content-EditTeacher">
            <div class="edit-main-container">
                <h3>Personal Information</h3>
                <br>
                <?php foreach($editInfo as $view){?>
                <div class="section-container">
                    <!-- Image -->
                    <div class="image-edit-container">
                        <img src="../../img/user-icon-default/user-male-default.png" alt="">
                        <label for="id">#<?php echo $view['accountID']?></label>
                        <label for="status" class="activeGreenLabel"><?php echo $status['status']?></label>
                    </div>

                    <!-- Section 1 -->
                    <div class="field-main-container">
                        <!-- Field 1 -->
                        <div class="field-one">
                            <div class="text-label-edit">
                                <p><?php echo $view['firstname']?></p>
                                <label for="editFirstName">First Name</label>
                            </div>
                            <div class="text-label-edit">
                                <p><?php echo $view['middlename']?></p>
                                <label for="editFirstName">Middle Name</label>
                            </div>
                            <div class="text-label-edit">
                                <p><?php echo $view['lastname']?></p>
                                <label for="editFirstName">Last Name</label>
                            </div>
                        </div>
                        <br>
                        <!-- Field 2 -->
                        <div class="field-one">
                            <div class="text-label-edit">
                                <p><?php echo $view['sex']?></p>
                                <label for="editFirstName">Sex</label>
                            </div>
                            <div class="text-label-edit">
                                <p><?php echo $view['username']?></p>
                                <label for="editFirstName">Registered Username</label>
                            </div>
                            <div class="text-label-edit">
                                <p><?php echo $view['password']?></p>
                                <label for="editFirstName">Password</label>
                            </div>
                        </div>
                        <br>
                        <!-- Field 2 -->
                        <div class="field-one">
                            <div class="text-label-edit">
                                <p><?php echo $view['faculty']?></p>
                                <label for="editFirstName">Faculty/Department</label>
                            </div>
                            <div class="text-label-edit">
                            </div>
                            <div class="text-label-edit">
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>
                
                <br>
                <h3>Section Handled</h3>
                <button type="button" class="addTeacher" onclick="openModalDetailTeacher()">Add Schedule</button>
                <br><br>
                <div class="section-container">
                    <div class="field-main-container">
                        <!-- ACCORDION -->
                        <?php 
                            foreach($sectionHandle as $index => $handle) { 
                                $schoolYear = $handle['schoolYear'];
                                $sections = $pdo->query("SELECT * FROM teacher_handle WHERE accountID = '$accountID' AND schoolYear = '$schoolYear' AND status=''")->fetchAll();
                        ?>
                        <button type="button" class="accordion" data-target="accordion-<?php echo $index; ?>"><?php echo $handle['schoolYear'];?> <b>S.Y.</b>
                            <span class="accordion-icon fas fa-plus"></span>
                            <span class="accordion-icon fas fa-minus"></span>
                        </button>
                        
                        <div class="panel" id="accordion-<?php echo $index; ?>">
                        <br>
                        <form action="../queries/teacher-query.php" method="get">
                            <table id="viewSection-<?php echo $index; ?>" class="display">
                                    <thead>
                                        <tr>
                                            <th>Subject Name</th>
                                            <th>Grade/Section</th>
                                            <th>Schedule</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                    <?php foreach ($sections as $section) { ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $section['subject']; ?></td>
                                            <td><?php echo $section['section']; ?></td>
                                            <td><?php echo $section['schedule']; ?></td>
                                            <td><button type="button" class="archive" onclick="removeSchedule('<?php echo $section['handleID']; ?>')">Remove</button></td>
                                        </tr>
                                    </tbody>
                                    <?php } ?>
                            </table>
                        </form>
                        <br>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
    </div>

    <?php include_once '../modal/teacher-add-detail.php';?>
</body>
<!-- Js link -->
<script src="../../js/accordion.js"></script>
<script src="../../js/modal.js"></script>
<script src="../../js/addInputType.js"></script>

<script>    
    // Initialize DataTable for each data table
    <?php foreach($sectionHandle as $index => $handle) { ?>
        new DataTable('#viewSection-<?php echo $index; ?>');
    <?php } ?>
</script>

<script>
    // Remove Alert
    function removeSchedule(handleID) {
        Swal.fire({
            icon: "question",
            title: "Remove",
            text: "Are you sure you want to remove this section?",
            showCancelButton: true,
        }).then(function (result) {
            if (result.isConfirmed) {
                // Redirect to the PHP script with the accountID parameter
                window.location.href = `../queries/teacher-query.php?remove&handleID=${handleID}`;
            }
        });
    }
</script>
</html>