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
        <form action="" method="">
            <div class="section-one-addTeacher">
                <div class="bind-label">
                    <label for="teacherName">Name:</label>
                    <input type="text" id="teacherName" name="teacherName" required>
                </div>
                <div class="bind-label">
                    <label for="teacherID">Employee ID:</label>
                    <input type="text" id="teacherID" name="teacherID" required>
                </div>
                <div class="bind-label">
                    <label for="teacherFaculty">Faculty:</label>
                    <input type="text" id="teacherFaculty" name="teacherFaculty" required>
                </div>
            </div>

            <div class="section-two-addTeacher">
                <label for="teacherUsername">Username:</label>
                <input type="text" id="teacherUsername" name="teacherUsername" required>
            </div>

            <p><b>Section to handle</b> Please click the radio button if its your advisee</p>

            <div class="section-three-addTeacher">
                <div class="bind-label">
                    <label for="teacherUsername">Schedule:</label>
                    <input type="text" id="teacherSchedule" name="teacherSchedule" required>
                </div>
                <div class="bind-label">
                    <label for="teacherUsername">Section Name:</label>
                    <input type="text" id="teacherSection" name="teacherSection" required>
                </div>
                <div class="bind-label">
                    <label for="">sdsda</label>
                    <input type="text" id="teacherUsername" name="teacherUsername" required>
                </div>
            </div>

            <div class="section-fourth-addTeacher">
                <button>Add Section</button>
                <button class="addBtn">ADD NEW TEACHER</button>
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
                            <p>201912344</p>
                            <label for="EmployeeNumb">Employee No.</label>
                        </caption>
                    </div>
                    <caption>
                        <p>#Aya2t05</p>
                        <label for="EmployeeName">Registered Username</label>
                    </caption>
                    <hr>
                    <caption>
                        <p>Arianne Quimpo</p>
                        <label for="EmployeeName">Full Name</label>
                    </caption>
                    <hr>
                    <caption>
                        <p>English Department</p>
                        <label for="EmployeeDept">Department</label>
                    </caption>
                    <hr>
                    <caption>
                        <p>G9-Jose Rizal</p>
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
                            <th>Grade</th>
                            <th>Section</th>
                            <th>Schedule</th>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>Del Pilar</td>
                            <td>12:00PM-1:00PM</td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>Narra</td>
                            <td>9:00AM-10:00AM</td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Masipag</td>
                            <td>4:00PM-6:00PM</td>
                        </tr>
                    </table>
                </div>
            </div>
        
    </div>
</div>

<?php
?>