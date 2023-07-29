<?php
session_start();
include '../../connection/db_conn.php';
include '../../connection/session.php';
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
        <form action="../admin/queries/teacher-query.php" id="editForm" method="POST">
            <div class="edit-main-container">
                <h3>Personal Information</h3>
                <br>
                <div class="section-container">
                    <!-- Image -->
                    <div class="image-edit-container">
                        <img src="../../img/user-icon-default/user-male-default.png" alt="">
                        <label for="id">#120520</label>
                    </div>

                    <!-- Section 1 -->
                    <div class="field-main-container">
                        <!-- Field 1 -->
                        <div class="field-one">
                            <div class="text-label-edit">
                                <input type="text" id="firstName" name="firstname">
                                <label for="editFirstName">First Name<span class="asterisk">*</span></label>
                            </div>
                            <div class="text-label-edit">
                                <input type="text" id="middleName">
                                <label for="editFirstName">Middle Name</label>
                            </div>
                            <div class="text-label-edit">
                                <input type="text" id="lastName">
                                <label for="editFirstName">Last Name<span class="asterisk">*</span></label>
                            </div>
                        </div>
                        <!-- Field 2 -->
                        <div class="field-one">
                            <div class="text-label-edit">
                                <input type="text">
                                <label for="editFirstName">Registered Username<span class="asterisk">*</span></label>
                            </div>
                            <div class="text-label-edit">
                                <input type="text">
                                <label for="editFirstName">Faculty/Department<span class="asterisk">*</span></label>
                            </div>
                            <div class="text-label-edit">
                                <input type="text">
                                <label for="editFirstName">Section Advisee<span class="asterisk">*</span></label>
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
                        
                        <?php for($i=1; $i<=10; $i++){?>
                        <div class="field-one">
                            <div class="text-label-edit">
                                <input type="text" id="teacherSubject<?php echo $i ?>" name="teacherSubject<?php echo $i ?>">
                            </div>
                            <div class="text-label-edit">
                                <input type="text" id="teacherSection<?php echo $i ?>" name="teacherSection<?php echo $i ?>">
                            </div>
                            <div class="text-label-edit">
                                <input type="text" id="teacherSchedule<?php echo $i ?>" name="teacherSchedule<?php echo $i ?>">
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