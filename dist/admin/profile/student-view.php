<?php
session_start();
include '../../connection/db_conn.php';
include '../../connection/session.php';
include '../../connection/session_name.php';

$studentID = $_GET['id'];
$studentNumber = $_GET['studNum'];
$editInfo = $pdo->query("SELECT * FROM student WHERE studentID = '$studentID'")->fetch();

$studentAttendance = $pdo->query("SELECT * FROM attendance_record 
        INNER JOIN student ON attendance_record.studentNumber = student.studentNumber
        INNER JOIN account_information ON attendance_record.accountID = account_information.accountID
        WHERE attendance_record.studentNumber = '$studentNumber'")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../../connection/link.php'?>
    <title>Edit</title>
</head>
<body>
    <!-- Topbar -->
    <?php include_once '../../navbar/topbar.php'?>
    <!-- Sidebar -->
    <?php include_once '../../navbar/sidebar.php'?>

    <!-- The Modal Edit Teacher-->

    <div class="modal-content-EditTeacher">
        <!-- Form to Submit -->
            <div class="edit-main-container">
                <h3>Personal Information</h3>
                <br>
                <div class="section-container">
                    <!-- Image -->
                    <div class="image-edit-container studentImage">
                        <img src="../../img/user-icon-default/user-male-default.png" alt="">
                        <label for="id">#<?php echo $editInfo['studentNumber']?></label>
                        <a href="../../qr-images/<?php echo $editInfo['qrImage']?>" download>
                        <button type="button"> Download QR</button>
                        </a>
                        <input type="hidden" name="studentID" value="<?php echo $editInfo['studentID']?>"> 
                    </div>

                    <!-- Section 1 -->
                    <div class="field-main-container studentProfile">
                        <!-- Field 1 -->
                        <div class="field-one">
                            <div class="text-label-edit">
                                <p><?php echo $editInfo['firstname']?></p>
                                <label for="editFirstName">First Name<span class="asterisk">*</span></label>
                            </div>
                            <div class="text-label-edit">
                                <p><?php echo $editInfo['middlename']?></p>
                                <label for="editFirstName">Middle Name</label>
                            </div>
                            <div class="text-label-edit">
                                <p><?php echo $editInfo['lastname']?></p>
                                <label for="editFirstName">Last Name<span class="asterisk">*</span></label>
                            </div>
                        </div>
                        <br>
                        <!-- Field 2 -->
                        <div class="field-one">
                            <div class="text-label-edit">
                                <?php 
                                    $bdate= $editInfo['studentBdate'];
                                    $formattedDate = date("M d, Y", strtotime($bdate));
                                ?>
                                <p><?php echo $formattedDate?></p>
                                <label for="editFirstName">Birthdate<span class="asterisk">*</span></label>
                            </div>
                            <div class="text-label-edit">
                                <p><?php echo $editInfo['studentGender']?></p>
                                <label for="editFirstName">Gender<span class="asterisk">*</span></label>
                            </div>
                            <div class="text-label-edit">
                            </div>
                        </div>
                        <br>
                        <hr><br>
                        <!-- Field 3 -->
                        <div class="field-one">
                            <div class="text-label-edit">
                                <p><?php echo $editInfo['studentNumber']?></p>
                                <label for="editFirstName">Student Number<span class="asterisk">*</span></label>
                            </div>
                            <div class="text-label-edit">
                                <p><?php echo $editInfo['studentSection']?></p>
                                <label for="editFirstName">Section<span class="asterisk">*</span></label>
                            </div>
                            <div class="text-label-edit">
                                <p><?php echo $editInfo['studentYear']?></p>
                                <label for="editFirstName">Year Enrolled<span class="asterisk">*</span></label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <br>
                <h3>Attendance Record</h3>
                <br>
                
                <div class="section-container">
                    <div class="field-main-container">

                        <!-- ACCORDION -->
                        <?php 
                            foreach($studentAttendance as $index => $handle){ 
                                $record = $pdo->query("SELECT * FROM attendance_record WHERE studentNumber = '$studentNumber' AND qrMonth = '$handle[qrMonth]' AND qrYear = '$handle[qrYear]' AND status=''")->fetchAll();
                        ?>
                        <button type="button" class="accordion" data-target="accordion-<?php echo $index; ?>"><?php echo $handle['qrMonth'].' '.$handle['qrYear'];?>
                            <span class="accordion-icon fas fa-plus"></span>
                            <span class="accordion-icon fas fa-minus"></span>
                        </button>

                        <div class="panel" id="accordion-<?php echo $index; ?>">
                            <form action="">
                                <br>
                                <table id="viewStudent-<?php echo $index; ?>" class="display">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Time-in</th>
                                            <th>Subject</th>
                                            <th>Prof</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                    <?php foreach ($record as $records) { ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $records['qrDate']; ?></td>
                                            <td><?php echo $records['qrTime']; ?></td>
                                            <td><?php echo $records['qrSubject']; ?></td>
                                            <td><?php echo $records['qrSubject']; ?></td>
                                            <td><button type="button" class="archive" onclick="removeRecord('<?php echo $records['attendanceID']; ?>')">Remove</button></td>
                                        </tr>
                                    </tbody>
                                    <?php } ?>
                                </table>
                                <br>
                            </form>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
    </div>
</body>
<!-- Js link -->
<script src="../../js/accordion.js"></script>
<script>    
    // Initialize DataTable for each data table
    <?php foreach($studentAttendance as $index => $handle) { ?>
        new DataTable('#viewStudent-<?php echo $index; ?>');
    <?php } ?>
</script>

<script>
    // Remove Alert
    function removeRecord(attendanceID) {
        Swal.fire({
            icon: "question",
            title: "Remove",
            text: "Are you sure you want to remove this record?",
            showCancelButton: true,
        }).then(function (result) {
            if (result.isConfirmed) {
                // Redirect to the PHP script with the accountID parameter
                window.location.href = `../queries/student-query.php?remove&attendanceID=${attendanceID}`;
            }
        });
    }
</script>
</html>