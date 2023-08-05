<?php
session_start();
include '../../connection/db_conn.php';
include '../../connection/session.php';
include '../../connection/session_name.php';

$studentID = $_GET['id'];
$editInfo = $pdo->query("SELECT * FROM student WHERE studentNumber = '$studentID'")->fetch();

$studentAttendance = $pdo->query("SELECT * FROM attendance_record 
        INNER JOIN student ON attendance_record.studentNumber = student.studentNumber
        INNER JOIN account_information ON attendance_record.accountID = account_information.accountID
        WHERE attendance_record.studentNumber = '$studentID'")->fetchAll();
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
       
        <center>
            <h2>Edit Student's Profile</h2>
            <p>Please input required field with <span class="asterisk">*</span></p>
            <br><br>
        </center>
        
       
        <!-- Form to Submit -->
        <form action="../queries/student-query.php" method="POST">
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
                                <input type="text" name="firstname" value="<?php echo $editInfo['firstname']?>" required>
                                <label for="editFirstName">First Name<span class="asterisk">*</span></label>
                            </div>
                            <div class="text-label-edit">
                                <input type="text" name="middlename" value="<?php echo $editInfo['middlename']?>">
                                <label for="editFirstName">Middle Name</label>
                            </div>
                            <div class="text-label-edit">
                                <input type="text" name="lastname" value="<?php echo $editInfo['lastname']?>" required>
                                <label for="editFirstName">Last Name<span class="asterisk">*</span></label>
                            </div>
                        </div>
                        <br>
                        <!-- Field 2 -->
                        <div class="field-one">
                            <div class="text-label-edit">
                                <input type="date" name="studentBdate" value="<?php echo $editInfo['studentBdate']?>" required>
                                <label for="editFirstName">Birthdate<span class="asterisk">*</span></label>
                            </div>
                            <div class="text-label-edit">
                                <input type="text" name="studentGender" value="<?php echo $editInfo['studentGender']?>" required>
                                <label for="editFirstName">Gender<span class="asterisk">*</span></label>
                            </div>
                            <div class="text-label-edit">
                            </div>
                        </div>
                        <br>

                        <p>School Information</p>
                        <hr><br>
                        <!-- Field 3 -->
                        <div class="field-one">
                            <div class="text-label-edit">
                                <input type="text" name="studentNumber" value="<?php echo $editInfo['studentNumber']?>" required>
                                <label for="editFirstName">Student Number<span class="asterisk">*</span></label>
                            </div>
                            <div class="text-label-edit">
                                <input type="text" name="studentSection" value="<?php echo $editInfo['studentSection']?>" required>
                                <label for="editFirstName">Section<span class="asterisk">*</span></label>
                            </div>
                            <div class="text-label-edit">
                                <input type="text" name="studentYear" value="<?php echo $editInfo['studentYear']?>" required>
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
                            foreach($studentAttendance as $handle){ 
                                $record = $pdo->query("SELECT * FROM attendance_record WHERE studentNumber = '$studentID' AND qrMonth = '$handle[qrMonth]' AND qrYear = '$handle[qrYear]'")->fetchAll();
                        ?>
                        <button type="button" class="accordion"><?php echo $handle['qrMonth'].' '.$handle['qrYear'];?> <b>S.Y.</b>
                            <span class="accordion-icon fas fa-plus"></span>
                            <span class="accordion-icon fas fa-minus"></span>
                        </button>

                        <div class="panel">
                            <div class="field-one sectionTag">
                                <div class="text-label-edit">
                                    <label for="">Date</label>
                                </div>
                                <div class="text-label-edit">
                                    <label for="">Time-in</label>
                                </div>
                                <div class="text-label-edit">
                                    <label for="">Subject</label>
                                </div>
                            </div>

                            <?php foreach ($record as $records) { ?>
                                <br>
                                <div class="field-one">
                                    <div class="text-label-edit">
                                        <input type="hidden" name="attendanceID[]" value="<?php echo $records['attendanceID']; ?>"> 
                                        <input type="text" name="qrDate[]" value="<?php echo $records['qrDate']; ?>">
                                    </div>
                                    <div class="text-label-edit">
                                        <input type="text" name="qrTime[]" value="<?php echo $records['qrTime']; ?>">
                                    </div>
                                    <div class="text-label-edit">
                                        <input type="text" name="qrSubject[]" value="<?php echo $records['qrSubject']; ?>">
                                    </div>
                                </div>
                                <br>
                            <?php } ?>
                        </div>
                        <?php } ?>
                        <div class="button-edit">
                            <button type="submit" name="editStudent">Save Changes</button>
                        </div>
                    </div>
                </div>


            </div>
         </form>
        
    </div>
</body>
<!-- Js link -->
<script src="../../js/accordion.js"></script>
</html>