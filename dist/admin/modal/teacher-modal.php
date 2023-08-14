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
                    <label for="teacherSex">Sex<span class="asterisk">*</span></label>
                    <select name="teacherSex" id="teacherSex" required>
                        <option selected disabled>Select Sex</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
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
            <div class="section-one-addTeacher">
                <div class="bind-label">
                    <label for="teacherUName">Username<span class="asterisk">*</span></label>
                    <input type="text" id="teacherUName" name="teacherUName" required>
                </div>
                <div class="bind-label">
                </div>
                <div class="bind-label">
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
                                        <?php for($i=0; $i<=59; $i++){ 
                                            $formattedValue = ($i < 10) ? '0' . $i : $i;
                                        ?>
                                            <option value="<?php echo $formattedValue; ?>"><?php echo $formattedValue; ?></option>
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
                                        <?php for($i=0; $i<=59; $i++){ 
                                            $formattedValue = ($i < 10) ? '0' . $i : $i;
                                        ?>
                                            <option value="<?php echo $formattedValue; ?>"><?php echo $formattedValue; ?></option>
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
                    <button type="button" disabled class="removeBtn"><i class="fa-regular fa-square-minus"></i></button>
                </div>
            </div>
        </div>

        <div class="section-fourth-addTeacher">
            <button id="addSectionBtn" type="button">Add Section <i class="fa-solid fa-plus"></i></button>
            <button type="submit" class="addBtn" name="addTeacher">ADD NEW TEACHER</button>
        </div>
        </form>
    </div>
</div>


<!-- The Modal View Teacher-->
<div id="viewTeacherModal" class="modalViewTeacher">
    <div class="modal-content-ViewTeacher">
        <!-- <span class="closeViewTeacher" onclick="closeModalViewTeacher()">&times;</span> -->
        
        <div class="section-container">
        <!-- Image -->
        <div class="image-edit-container">
            <img src="../img/user-icon-default/user-male-default.png" alt="">
            <label for="id">#<span id="employeeNumber"></span></label>
            <i class="fa-regular fa-pen-to-square"></i>
        </div>

        <!-- Section 1 -->
        <div class="field-main-container">
            <!-- Field 1 -->
            <div class="field-one">
                <div class="text-label-edit">
                    <p id="fname"></p>
                    <label for="editFirstName">First Name<span class="asterisk">*</span></label>
                </div>
                <div class="text-label-edit">
                    <p id="mname"></p>
                    <label for="editFirstName">Middle Name</label>
                </div>
                <div class="text-label-edit">
                    <p id="lname"></p>
                    <label for="editFirstName">Last Name<span class="asterisk">*</span></label>
                </div>
            </div>
            <br>
            <!-- Field 2 -->
            <div class="field-one">
                <div class="text-label-edit">
                    <p id="registeredUsername"></p>
                    <label for="editFirstName">Registered Username<span class="asterisk">*</span></label>
                </div>
                <div class="text-label-edit">
                    <p id="department"></p>
                    <label for="editFirstName">Faculty/Department<span class="asterisk">*</span></label>
                </div>
                <div class="text-label-edit">
                    <p id="password"></p>
                    <label for="editFirstName">Password<span class="asterisk">*</span></label>
                </div>
            </div>
            <div class="field-one buttonView">
            <div class="text-label-edit">
                <p id="password"></p>
                <button onclick="closeModalViewTeacher()" class="close">Close</button>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>

<?php
?>