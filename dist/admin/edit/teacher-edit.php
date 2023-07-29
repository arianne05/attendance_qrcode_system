<?php
session_start();
include '../../connection/db_conn.php';
include '../../connection/session.php';

$accountID = $_GET['id'];
$editInfo = $pdo->query("SELECT * FROM account_information 
        INNER JOIN teacher_handle ON account_information.accountID = teacher_handle.accountID
        WHERE account_information.accountID = '$accountID' AND account_information.position = 'teacher'")->fetch();
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
            <h2>Edit Teacher's Profile</h2>
            <p>Please input required field with <span class="asterisk">*</span></p>
            <br><br>
        </center>
        
       
        <!-- Form to Submit -->
        <form action="../queries/teacher-query.php" method="POST">
            <div class="edit-main-container">
                <h3>Personal Information</h3>
                <br>
                <div class="section-container">
                    <!-- Image -->
                    <div class="image-edit-container">
                        <img src="../../img/user-icon-default/user-male-default.png" alt="">
                        <label for="id">#<?php echo $editInfo['accountID']?></label>
                        <input type="hidden" name="accountID" value="<?php echo $editInfo['accountID']?>">
                    </div>

                    <!-- Section 1 -->
                    <div class="field-main-container">
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
                        <!-- Field 2 -->
                        <div class="field-one">
                            <div class="text-label-edit">
                                <input type="text" name="username" value="<?php echo $editInfo['username']?>" required>
                                <label for="editFirstName">Registered Username<span class="asterisk">*</span></label>
                            </div>
                            <div class="text-label-edit">
                                <input type="text" name="faculty" value="<?php echo $editInfo['faculty']?>" required>
                                <label for="editFirstName">Faculty/Department<span class="asterisk">*</span></label>
                            </div>
                            <div class="text-label-edit">
                                <input type="text" name="password" value="<?php echo $editInfo['password']?>" required>
                                <label for="editFirstName">Password<span class="asterisk">*</span></label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <br>
                <h3>Section Handled</h3>
                <br>
                
                <div class="section-container">
                    <div class="field-main-container">
                        <div class="field-one">
                            <div class="text-label-edit sectionTag">
                                <label for="editFirstName">Subject Name</label>
                            </div>
                            <div class="text-label-edit sectionTag">
                                <label for="editFirstName">Section Name</label>
                            </div>
                            <div class="text-label-edit sectionTag">
                                <label for="editFirstName">Schedule</label>
                            </div>
                        </div>
                        
                        <?php for($i=1; $i<=10; $i++){
                            $countSub = 'subject'.$i; 
                            $countSec = 'section'.$i; 
                            $countSch = 'sched'.$i; 
                        ?>
                        <div class="field-one">
                            <div class="text-label-edit">
                                <input type="text" value="<?php echo $editInfo[$countSub]?>" name="teacherSubject<?php echo $i ?>">
                            </div>
                            <div class="text-label-edit">
                                <input type="text" value="<?php echo $editInfo[$countSec]?>" name="teacherSection<?php echo $i ?>">
                            </div>
                            <div class="text-label-edit">
                                <input type="text" value="<?php echo $editInfo[$countSch]?>" name="teacherSchedule<?php echo $i ?>">
                            </div>
                        </div>
                        <br>
                        <?php } ?>

                        <div class="button-edit">
                            <button type="submit" name="editTeacher">Save Changes</button>
                        </div>
                    </div>
                </div>

            </div>
         </form>
        
    </div>

</body>
</html>