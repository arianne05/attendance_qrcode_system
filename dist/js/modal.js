// Add and Close Modal for Teacher
function openModalAddTeacher() {
    document.getElementById("addTeacherModal").style.display = "block";
}

function closeModalAddTeacher() {
    document.getElementById("addTeacherModal").style.display = "none";
}

// View Teacher
function openModalViewTeacher(accountID) { // Fetch the teacher's information using AJAX
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const teacherData = JSON.parse(xhr.responseText);
                populateModalWithTeacherData(teacherData);
                document.getElementById("viewTeacherModal").style.display = "block";
            } else {
                alert('Error fetching teacher information.');
            }
        }
    };

    xhr.onerror = function () {
        alert('Request error.');
    };

    xhr.open('GET', '../admin/queries/get_teacher_info.php?accountID=' + accountID, true); // Updated path
    xhr.send();
}

function populateModalWithTeacherData(data) {
    document.getElementById("employeeNumber").textContent = data.accountID;
    document.getElementById("registeredUsername").textContent = data.username;
    document.getElementById("fname").textContent = textContent = data.firstname;
    document.getElementById("lname").textContent = textContent = data.lastname;
    document.getElementById("mname").textContent = textContent = data.middlename;
    // document.getElementById("fullName").textContent = `${data.firstname} ${data.middlename} ${data.lastname}`;
    document.getElementById("department").textContent = data.faculty;
    document.getElementById("password").textContent = data.password;
    // document.getElementById("handleID").textContent = data.handleID;
    // document.getElementById("schedule").textContent = data.schedule;
    
}


function closeModalViewTeacher() {
    document.getElementById("viewTeacherModal").style.display = "none";
}

// Detail Teacher Button
function openModalDetailTeacher() {
    document.getElementById("detailTeacherModal").style.display = "block";
}

function closeModalDetailTeacher() {
    document.getElementById("detailTeacherModal").style.display = "none";
}


/*-----------------------------------------------------------------------------------------------------------------------*/
/* MODAL FOR STUDENT-ADMIN */

// Add Student
function openModalAddStudent() {
    document.getElementById("addStudentModal").style.display = "block";
}

function closeModalAddStudent() {
    document.getElementById("addStudentModal").style.display = "none";
}

// View Student
function openModalViewStudent(studentID) {
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const studentData = JSON.parse(xhr.responseText);
                populateModalWithStudentData(studentData);
                document.getElementById("viewStudentModal").style.display = "block";
            } else {
                alert('Error fetching student information.'); // Updated error message
            }
        }
    };

    xhr.onerror = function () {
        alert('Request error.');
    };

    xhr.open('GET', '../admin/queries/get_student_info.php?studentID=' + studentID, true); // Updated parameter name
    xhr.send();
}


function populateModalWithStudentData(data) {
    document.getElementById("fname-student").textContent = textContent = data.firstname+" "+data.middlename+" "+data.lastname;
    document.getElementById("section-student").textContent = textContent = data.studentSection;
    document.getElementById("student-number").textContent = textContent = data.studentNumber;
    document.getElementById("student-gender").textContent = textContent = data.studentGender;
    document.getElementById("student-year").textContent = textContent = data.studentYear;
    
}

function closeModalViewStudent() {
    document.getElementById("viewStudentModal").style.display = "none";
}

