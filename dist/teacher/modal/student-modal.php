<?php
?>

<!-- The Modal Add Student-->
<div id="addStudentModal" class="modalAddStudent">
    <div class="modal-content-AddStudent">
        <span class="closeAddStudent" onclick="closeModalAddStudent()">&times;</span>
        <center>
            <h2>Add New Student</h2>
            <p>Please input required field with <span class="asterisk">*</span></p>
            <br><br>
        </center>
        

        <!-- Form to Submit -->
        <form action="../connection/generate-qr-teacher.php" method="post">
            <input type="hidden" name="accountID" value="<?php echo $_SESSION['accountID'];?>">
            <br>
            <p>Personal Information</p>
            <hr><br>  

            <!-- Section 1 -->
            <div class="section-one-addTeacher">
                <div class="bind-label">
                    <label for="firstname">First Name<span class="asterisk">*</span></label>
                    <input type="text" id="firstname" name="firstname" required>
                </div>
                <div class="bind-label">
                    <label for="middlename">Middle Name</label>
                    <input type="text" id="middlename" name="middlename">
                </div>
                <div class="bind-label">
                    <label for="lastname">Last Name<span class="asterisk">*</span></label>
                    <input type="text" id="lastname" name="lastname" required>
                </div>
            </div>

            <!-- Section 2 -->
            <br>
            <div class="section-one-addTeacher">
                <div class="bind-label">
                    <label for="studentBdate">Birthdate</label>
                    <input type="date" id="studentBdate" name="studentBdate">
                </div>
                <div class="bind-label">
                    <label for="studentGender">Gender<span class="asterisk">*</span></label>
                    <select name="studentGender" id="studentGender" required>
                        <option selected disabled>Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="bind-label">
                </div>
            </div>

            <br>
            <p>School Information</p>
            <hr><br>  

            <!-- Section 3 -->
            <br>
            <div class="section-one-addTeacher">
                <div class="bind-label">
                    <label for="studentGrade">Grade<span class="asterisk">*</span></label>
                    <input type="number" id="studentGrade" name="studentGrade" required>
                </div>
                <div class="bind-label">
                    <label for="studentSection">Section<span class="asterisk">*</span></label>
                    <input type="text" id="studentSection" name="studentSection" required>
                </div>
                <div class="bind-label">
                    <label for="studentNumber">Student Number<span class="asterisk">*</span></label>
                    <input type="number" id="studentNumber" name="studentNumber" required>
                </div>
            </div>

            <!-- Section 4 -->
            <br>
            <div class="section-one-addTeacher">
                <div class="bind-label">
                    <label>School Year:</label> <!--Label-->
                    <div class="sched-container"> <!--School Year-->
                        <div class="from-label">
                            <label>From:</label>
                            <input type="number" id="teacherSchedule1" name="teacherFromSchoolYear" required>
                        </div>
                        <div class="from-label">
                            <label>To:</label>
                            <input type="number" id="teacherSchedule1" name="teacherToSchoolYear" required>
                        </div>
                    </div>
                </div>
                <div class="bind-label">
                </div>
                <div class="bind-label">
                </div>
            </div>

            <div class="section-fourth-addTeacher">
                <button type="submit" name="generateQR" class="addBtn">GENERATE QR</button>
            </div>
        </form>
    </div>
</div>

<!-- The Modal View Student-->
<div id="viewStudentModal" class="modalViewStudent">
    <div class="modal-content-ViewStudent">
        
            <div class="studentView">
                <div class="personal-info-section">
                    <div class="first-section">
                        <img src="../img/user-icon-default/user-male-default.png" alt="">
                        <caption>
                            <p id="student-number"></p>
                            <label for="EmployeeNumb">Student No.</label>
                        </caption>
                    </div>
                    <caption>
                        <p id="fname-student"></p>
                        <label for="EmployeeName">Full Name</label>
                    </caption>
                    <hr>
                    <caption>
                        <p id="section-student"></p>
                        <label for="EmployeeDept">Section</label>
                    </caption>
                    <hr>
                    <caption>
                        <p id="student-gender"></p>
                        <label for="EmployeeDept">Gender</label>
                    </caption>
                    <hr>
                    <caption>
                        <p id="student-year"></p>
                        <label for="EmployeeDept">School Year Enrolled</label>
                    </caption>
                    <hr>

                    <div class="button-section">
                        <button class="closeStudentView" onclick="closeModalViewStudent()">Close</button>
                    </div>
                </div>
            </div>
                
            
    </div>
</div>

<!-- The Modal Edit Student-->
<div id="editStudentModal" class="modalEditStudent">
    <div class="modal-content-EditStudent">
        <span class="closeEditStudent" onclick="closeModalEditStudent()">&times;</span>
        <center>
            <h2>Edit Student's Profile</h2>
            <p>Please input required field with <span class="asterisk">*</span></p>
            <br><br>
        </center>
        

        <!-- Form to Submit -->
        <form action="" method="">
            <div class="edit-main-container">
                <!-- Image -->
                <div class="image-edit-container">
                    <img src="../img/user-icon-default/user-male-default.png" alt="">
                </div>

                <!-- Section 1 -->
                <div class="field-main-container">
                    <div class="text-label-edit">
                        <input type="text">
                        <label for="editFirstName">First Name</label>
                    </div>
                    <div class="text-label-edit">
                        <input type="text">
                        <label for="editFirstName">Middle Name</label>
                    </div>
                    <div class="text-label-edit">
                        <input type="text">
                        <label for="editFirstName">Last Name</label>
                    </div>
                </div>

                <!-- Section 2 -->
            <div class="field-main-container">
                <div class="text-label-edit">
                    <input type="text">
                    <label for="editFirstName">Student Number</label>
                </div>
                <div class="text-label-edit">
                    <input type="text">
                    <label for="editFirstName">Grade</label>
                </div>
                <div class="text-label-edit">
                    <input type="text">
                    <label for="editFirstName">Section</label>
                </div>
            </div>

            <!-- Section 3 -->
            <div class="field-main-container">
                <div class="text-label-edit">
                    <input type="text">
                    <label for="editFirstName">School Year</label>
                </div>
                <div class="text-label-edit">
                    <input type="text">
                    <label for="editFirstName">Adviser</label>
                </div>
                <div class="text-label-edit">
                </div>
            </div>

                
            <p>Subject Enrolled</p>
                <hr><!-- Section 3 -->
                <br>

                <div class="field-main-container">
                    <div class="text-label-edit">
                        <label for="editFirstName">Subject</label>
                    </div>
                    <div class="text-label-edit">
                        <label for="editFirstName">Teacher</label>
                    </div>
                    <div class="text-label-edit">
                        <label for="editFirstName">Schedule</label>
                    </div>
                </div>
                <div class="field-main-container">
                    <div class="text-label-edit">
                        <input type="text">
                    </div>
                    <div class="text-label-edit">
                        <input type="text">
                    </div>
                    <div class="text-label-edit">
                        <input type="text">
                    </div>
                </div>
                <br>
                <div class="field-main-container">
                    <div class="text-label-edit">
                        <input type="text">
                    </div>
                    <div class="text-label-edit">
                        <input type="text">
                    </div>
                    <div class="text-label-edit">
                        <input type="text">
                    </div>
                </div>
                <br>
                <div class="field-main-container">
                    <div class="text-label-edit">
                        <input type="text">
                    </div>
                    <div class="text-label-edit">
                        <input type="text">
                    </div>
                    <div class="text-label-edit">
                        <input type="text">
                    </div>
                </div>
                <br>
                <div class="field-main-container">
                    <div class="text-label-edit">
                        <input type="text">
                    </div>
                    <div class="text-label-edit">
                        <input type="text">
                    </div>
                    <div class="text-label-edit">
                        <input type="text">
                    </div>
                </div>
                <br>
                <div class="field-main-container">
                    <div class="text-label-edit">
                        <input type="text">
                    </div>
                    <div class="text-label-edit">
                        <input type="text">
                    </div>
                    <div class="text-label-edit">
                        <input type="text">
                    </div>
                </div>
                <br>
                <div class="field-main-container">
                    <div class="text-label-edit">
                        <input type="text">
                    </div>
                    <div class="text-label-edit">
                        <input type="text">
                    </div>
                    <div class="text-label-edit">
                        <input type="text">
                    </div>
                </div>
                <br>
                <div class="button-edit">
                    <button>Save Changes</button>
                </div>
            </div>
         </form>
    </div>
</div>


<?php
?>