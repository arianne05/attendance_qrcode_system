<?php
?>

<!-- The Modal Add Teacher-->
<div id="addTeacherModal" class="modalAddTeacher">
    <div class="modal-content-AddTeacher">
        <span class="closeAddTeacher" onclick="closeModalAddTeacher()">&times;</span>
        <center>
            <h2>Add New Teacher</h2>
            <p>Please input required field with <span class="asterisk">*</span></p>
            <br><br>
        </center>
        

        <!-- Form to Submit -->
        <form action="../admin/queries/teacher-query.php" method="POST">
            <div class="section-one-addTeacher">
                <div class="bind-label">
                    <label for="teacherFName">First Name<span class="asterisk">*</span></label>
                    <input type="text" id="teacherFName" name="teacherFName" required>
                </div>
                <div class="bind-label">
                    <label for="teacherMName">Middle Name</label>
                    <input type="text" id="teacherMName" name="teacherMName">
                </div>
                <div class="bind-label">
                    <label for="teacherLName">Last Name<span class="asterisk">*</span></label>
                    <input type="text" id="teacherLName" name="teacherLName" required>
                </div>
            </div>
            <br>
            <div class="section-one-addTeacher">
                <div class="bind-label">
                    <label for="teacherUName">Username<span class="asterisk">*</span></label>
                    <input type="text" id="teacherUName" name="teacherUName" required>
                </div>
                <div class="bind-label">
                    <label for="teacherPass">Password<span class="asterisk">*</span></label>
                    <input type="text" id="teacherPass" name="teacherPass" required>
                </div>
                <div class="bind-label">
                    <label for="teacherFaculty">Faculty<span class="asterisk">*</span></label>
                    <input type="text" id="teacherFaculty" name="teacherFaculty" required>
                </div>
            </div>
            <br>
            <p><b>Section to handle</b> Please click the radio button if its your advisee</p>

            <div id="sectionContainer">
            <!-- Initial section -->
            <div class="section-three-addTeacher">
                <div class="bind-label">
                    <label for="teacherSchedule1">Schedule:</label>
                    <input type="text" id="teacherSchedule1" name="teacherSchedule1">
                </div>
                <div class="bind-label">
                    <label for="teacherSection1">Section Name:</label>
                    <input type="text" id="teacherSection1" name="teacherSection1">
                </div>
                <div class="bind-label">
                    <label for="teacherSubject1">Subject Name:</label>
                    <input type="text" id="teacherSubject1" name="teacherSubject1">
                </div>
                <div class="withButton">
                    <label for="teacherSubject1">d</label>
                    <button disabled class="removeBtn"><i class="fa-regular fa-square-minus"></i></button>
                </div>
            </div>
        </div>

        <div class="section-fourth-addTeacher">
            <button id="addSectionBtn">Add Section <i class="fa-solid fa-plus"></i></button>
            <button type="submit" class="addBtn" name="addTeacher">ADD NEW TEACHER</button>
        </div>
        </form>
    </div>
</div>


<!-- The Modal View Teacher-->
<div id="viewTeacherModal" class="modalViewTeacher">
    <div class="modal-content-ViewTeacher">
        <span class="closeViewTeacher" onclick="closeModalViewTeacher()">&times;</span>
        <center>
            <h2>Teacher's Profile</h2>
            <br><br>
        </center>
        

        <!-- Form to Submit -->
        
            <div class="section-viewTeacher">
                <div class="personal-info-section">
                    <div class="first-section">
                        <img src="../img/user-icon-default/user-male-default.png" alt="">
                        <caption>
                            <p id="employeeNumber">201912344</p>
                            <label for="EmployeeNumb">Employee No.</label>
                        </caption>
                    </div>
                    <caption>
                        <p id="registeredUsername">Username</p>
                        <label for="EmployeeName">Registered Username</label>
                    </caption>
                    <hr>
                    <caption>
                        <p id="fullName">Arianne Quimpo</p>
                        <label for="EmployeeName">Full Name</label>
                    </caption>
                    <hr>
                    <caption>
                        <p id="department">English Department</p>
                        <label for="EmployeeDept">Department</label>
                    </caption>
                    <hr>
                    <caption>
                        <p id="sectionAdvisee">G9-Jose Rizal</p>
                        <label for="EmployeeDept">Section Advisee</label>
                    </caption>
                    <hr>

                    <div class="button-section">
                        <button>Deactivate</button>
                    </div>
                </div>

                <!-- Table -->
                <div class="class-table-section">
                    <p>2020-2023 S.Y</p>
                    <label for="">School Year</label>
                    <hr>
                    <table>
                        <tr>
                            <th>Subject</th>
                            <th>Section</th>
                            <th>Schedule</th>
                        </tr>
                        <?php for($i=1; $i<=10; $i++){ ?>
                        <tr>
                            <td id="subject<?php echo $i ?>"></td>
                            <td id="section<?php echo $i ?>"></td>
                            <td id="sched<?php echo $i ?>"></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
    </div>
</div>


<!-- The Modal Edit Teacher-->
<div id="editTeacherModal" class="modalEditTeacher">
    <div class="modal-content-EditTeacher">
        <span class="closeEditTeacher" onclick="closeModalEditTeacher()">&times;</span>
        <center>
            <h2>Edit Teacher's Profile</h2>
            <p>Please input required field with <span class="asterisk">*</span></p>
            <br><br>
        </center>
        

        <!-- Form to Submit -->
        <form action="../admin/queries/teacher-query.php" id="editForm" method="POST">
            <div class="edit-main-container">
                <!-- Image -->
                <div class="image-edit-container">
                    <img src="../img/user-icon-default/user-male-default.png" alt="">
                </div>

                <!-- Section 1 -->
                <div class="field-main-container">
                    <div class="text-label-edit">
                        <input type="text" id="firstName" name="firstname">
                        <label for="editFirstName">First Name</label>
                    </div>
                    <div class="text-label-edit">
                        <input type="text" id="middleName">
                        <label for="editFirstName">Middle Name</label>
                    </div>
                    <div class="text-label-edit">
                        <input type="text" id="lastName">
                        <label for="editFirstName">Last Name</label>
                    </div>
                </div>

                <!-- Section 2 -->
                <div class="field-main-container">
                    <div class="text-label-edit">
                        <input type="text">
                        <label for="editFirstName">Registered Username</label>
                    </div>
                    <div class="text-label-edit">
                        <input type="text">
                        <label for="editFirstName">Faculty/Department</label>
                    </div>
                    <div class="text-label-edit">
                        <input type="text">
                        <label for="editFirstName">Section Advisee</label>
                    </div>
                </div>

                
                <p>Section Handled</p>
                <hr><!-- Section 3 -->
                <br>

                <div class="field-main-container">
                    <div class="text-label-edit">
                        <label for="editFirstName">Subject Name</label>
                    </div>
                    <div class="text-label-edit">
                        <label for="editFirstName">Section Name</label>
                    </div>
                    <div class="text-label-edit">
                        <label for="editFirstName">Schedule</label>
                    </div>
                </div>
                <?php 
                for($i=1; $i<=10; $i++){?>
                    <div class="field-main-container">
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
         </form>
        
    </div>
</div>

<?php
?>