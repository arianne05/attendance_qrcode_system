<?php
?>

<!-- The Modal -->
<div id="addTeacherModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <!-- Add your form elements here to add a new teacher -->
        <center>
            <h2>Add New Teacher</h2>
            <p>Please input required field with <span>*</span></p>
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

<?php
?>