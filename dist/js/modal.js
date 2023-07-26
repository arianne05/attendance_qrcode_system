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

function populateModalWithTeacherData(data) { //fetch data from the database and display using ID name
    document.getElementById("employeeNumber").textContent = data.accountID;
    document.getElementById("registeredUsername").textContent = data.username;
    document.getElementById("fullName").textContent = data.firstname + ' ' + data.middlename + ' ' + data.lastname;
    document.getElementById("department").textContent = data.faculty; 
    document.getElementById("sectionAdvisee").textContent = data.section_advisee;
}

function closeModalViewTeacher() {
    document.getElementById("viewTeacherModal").style.display = "none";
}

// Edit Teacher
function openModalEditTeacher() {
    document.getElementById("editTeacherModal").style.display = "block";
}

function closeModalEditTeacher() {
    document.getElementById("editTeacherModal").style.display = "none";
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
function openModalViewStudent() {
    document.getElementById("viewStudentModal").style.display = "block";
}

function closeModalViewStudent() {
    document.getElementById("viewStudentModal").style.display = "none";
}

// Edit Student
function openModalEditStudent() {
    document.getElementById("editStudentModal").style.display = "block";
}

function closeModalEditStudent() {
    document.getElementById("editStudentModal").style.display = "none";
}