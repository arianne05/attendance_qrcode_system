<?php
?>

<!-- The Modal Add Schedule -->
<div id="detailTeacherModal" class="modalDetailTeacher">
    <div class="modal-content-DetailTeacher">
        <span class="closeDetailTeacher" onclick="closeModalDetailTeacher()">&times;</span>
        
        <form action="../../admin/queries/teacher-query.php" method="POST">
            <input type="hidden" name="accountID" value="<?php echo $accountID;?>">
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
                    <button disabled class="removeBtn"><i class="fa-regular fa-square-minus"></i></button>
                </div>
            </div>
        </div>

        <div class="section-fourth-addTeacher">
            <button type="button" id="addSectionBtn">Add Section <i class="fa-solid fa-plus"></i></button>
            <button type="submit" class="addBtn" name="addSchedule">ADD NEW TEACHER</button>
        </div>
        </form>
    </div>
</div>
<?php
?>