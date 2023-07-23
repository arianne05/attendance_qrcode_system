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
        <form action="" method="">
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

            <!-- Section 2 -->
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

            <div class="section-fourth-addTeacher">
                <button class="addBtn">ADD NEW STUDENT</button>
            </div>
        </form>
    </div>
</div>

<div id="viewStudentModal" class="modalViewStudent">
    <div class="modal-content-ViewStudent">
        <span class="closeViewStudent" onclick="closeModalViewStudent()">&times;</span>
        <center>
            <h2>Student's Profile</h2>
            <br><br>
        </center>
        

        <!-- Form to Submit -->
        
            <div class="section-viewTeacher">
                <div class="personal-info-section">
                    <div class="first-section">
                        <img src="../img/user-icon-default/user-male-default.png" alt="">
                        <caption>
                            <p>201912344</p>
                            <label for="EmployeeNumb">Student No.</label>
                        </caption>
                    </div>
                    <caption>
                        <p>Arianne Quimpo</p>
                        <label for="EmployeeName">Full Name</label>
                    </caption>
                    <hr>
                    <caption>
                        <p>G9-Jose Rizal</p>
                        <label for="EmployeeDept">Section</label>
                    </caption>
                    <hr>
                    <caption>
                        <p>Prof. Alejandro Lady</p>
                        <label for="EmployeeDept">Adviser</label>
                    </caption>
                    <hr>
                    <caption>
                        <p>S.Y 2019-2020</p>
                        <label for="EmployeeDept">School Year Enrolled</label>
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
                            <th>Teacher</th>
                            <th>Schedule</th>
                        </tr>
                        <tr>
                            <td>English</td>
                            <td>Prof. Gladys Perey</td>
                            <td>10:00PM-3:00PM</td>
                        </tr>
                        <tr>
                            <td>Araling Panlipunan</td>
                            <td>Prof. Anabelle Almarez</td>
                            <td>12:00PM-1:00PM</td>
                        </tr>
                        <tr>
                            <td>Science</td>
                            <td>Prof. Jake Ersando</td>
                            <td>6:00AM-1:00PM</td>
                        </tr>
                    </table>
                </div>
            </div>
    </div>
</div>


<?php
?>