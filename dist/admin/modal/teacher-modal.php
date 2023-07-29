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
                <!-- SCHEDULE -->
                <div class="bind-label">
                    <label for="schedule">Schedule</label>

                    <div class="sched-container">
                        <!-- From Label -->
                        <div class="from-label">
                            <label>From:</label> <!-- Label -->
                            <div class="main-select-container"> <!-- Selects -->
                                <!-- Select 1 -->
                                <div class="select-container">
                                    <select name="schedFromHour1">
                                    <?php for($i=1; $i<=12; $i++){ ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                                <!-- Select 2 -->
                                <div class="select-container">
                                    <select name="schedFromMin1">
                                        <?php for($i=1; $i<=59; $i++){ ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <!-- Select 3 -->
                                <div class="select-container">
                                    <select name="schedFromPeriod1">
                                        <option value="AM">AM</option>
                                        <option value="PM">PM</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- To Label -->
                        <div class="from-label">
                            <label for="teacherSchedule1">To:</label> <!-- Label -->
                            <div class="main-select-container"> <!-- Selects -->
                                <!-- Select 1 -->
                                <div class="select-container">
                                    <select name="schedToHour1">
                                    <?php for($i=1; $i<=12; $i++){ ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                                <!-- Select 2 -->
                                <div class="select-container">
                                    <select name="schedToMin1">
                                        <?php for($i=1; $i<=59; $i++){ ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <!-- Select 3 -->
                                <div class="select-container">
                                    <select name="schedToPeriod1">
                                        <option value="AM">AM</option>
                                        <option value="PM">PM</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- GRADE -->
                <div class="bind-label">
                    <br>
                    <label>Grade:</label>
                    <input type="text" id="teacherGrade1" name="teacherGrade1">
                </div>
                <!-- SECTION -->
                <div class="bind-label">
                    <br>
                    <label>Section:</label>
                    <input type="text" id="teacherSection1" name="teacherSection1">
                </div>
                <!-- SUBJECT -->
                <div class="bind-label">
                    <br>
                    <label>Subject Name:</label>
                    <input type="text" id="teacherSubject1" name="teacherSubject1">
                </div>

                <!-- School Year -->
                <div class="bind-label">
                    <label>School Year:</label> <!--Label-->
                    <div class="sched-container"> <!--School Year-->
                        <div class="from-label">
                            <label>From:</label>
                            <input type="number" id="teacherSchedule1" name="teacherFromSchoolYear1">
                        </div>
                        <div class="from-label">
                            <label>To:</label>
                            <input type="number" id="teacherSchedule1" name="teacherToSchoolYear1">
                        </div>
                    </div>
                </div>
                <div class="withButton">
                    <br>
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

<?php
?>