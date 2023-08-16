<?php
// Index page alert
if(isset($_GET['warningLogin1'])){
    ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Empty Field',
                text: 'Please input username and password!'
            })
        </script>
    <?php
}
if(isset($_GET['warningLogin2'])){
    ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Empty Username',
                text: 'Please input username!'
            })
        </script>
    <?php
}
if(isset($_GET['warningLogin3'])){
    ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Empty Password',
                text: 'Please input password!'
            })
        </script>
    <?php
}
if(isset($_GET['warningLogin4'])){
    ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Incorrect Username and Password',
                text: 'Please input correct username and password!'
            })
        </script>
    <?php
}

//Session error alert
if(isset($_GET['errorSession'])){
    ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oopss..',
                text: 'Login to the system please!'
            })
        </script>
    <?php
}

// Welcome Dashboard Sweet Alert
if(isset($_GET['loginSuccess'])){
    ?>
        <script>
            Swal.fire({
                toast: true,
                position: 'top-right',
                icon: 'success',
                iconColor: 'green',
                title: 'Welcome, Admin!',
                customClass: {
                    popup: 'toast'
                },
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
            })
        </script>
    <?php
}

// Teacher-Add-Success
if(isset($_GET['addTeacherSuccess'])){
    ?>
        <script>
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Added Successfully',
            showConfirmButton: false,
            timer: 1500
            })
        </script>
    <?php
}
// Teacher-Edit-Success
if(isset($_GET['updateTeacherSuccess'])){
    ?>
        <script>
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Update Successfully',
            showConfirmButton: false,
            timer: 1500
            })
        </script>
    <?php
}
// Teacher Deactivate Success
if(isset($_GET['deactTeacherSuccess'])){
    ?>
        <script>
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Account Deactivated',
            showConfirmButton: false,
            timer: 1500
            })
        </script>
    <?php
}
// Teacher Activate Success
if(isset($_GET['actTeacherSuccess'])){
    ?>
        <script>
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Account Activated',
            showConfirmButton: false,
            timer: 1500
            })
        </script>
    <?php
}

// Teacher Added Sched Success - Profile
if(isset($_GET['updateSchedSuccess'])){
    ?>
        <script>
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Schedule Added!',
            showConfirmButton: false,
            timer: 1500
            })
        </script>
    <?php
}
// Teacher Removed Sched Success - Profile
if(isset($_GET['removedSchedSuccess'])){
    ?>
        <script>
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Section Removed!',
            showConfirmButton: false,
            timer: 1500
            })
        </script>
    <?php
}

/*-------------------------------------------------------------------------------------------------------------- */

// Student Added Success
if(isset($_GET['studentAddSuccess'])){
    ?>
        <script>
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Registered Successfully!',
            showConfirmButton: false,
            timer: 1500
            })
        </script>
    <?php
}

// Student Edit Success
if(isset($_GET['updateStudentSuccess'])){
    ?>
        <script>
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Edit Successfully!',
            showConfirmButton: false,
            timer: 1500
            })
        </script>
    <?php
}
// Student Remove Success
if(isset($_GET['removedTeacherSuccess'])){
    ?>
        <script>
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Account Removed!',
            showConfirmButton: false,
            timer: 1500
            })
        </script>
    <?php
}
// Student Restore Success
if(isset($_GET['restoreTeacherSuccess'])){
    ?>
        <script>
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Account Restored!',
            showConfirmButton: false,
            timer: 1500
            })
        </script>
    <?php
}
// __________________________________________________________________________________

// Change My Profile Information
if(isset($_GET['emptyPassandCP'])){
    ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Empty Fields',
                text: 'Please input password and confirm password!'
            })
        </script>
    <?php
}
if(isset($_GET['emptyCP'])){
    ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Input confirm password',
                text: 'Please confirm password!'
            })
        </script>
    <?php
}
if(isset($_GET['wrongCP'])){
    ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Password mismatch',
                text: 'Please enter correct password!'
            })
        </script>
    <?php
}
if(isset($_GET['securitySaved'])){
    ?>
        <script>
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Security Detail Updated!',
            showConfirmButton: false,
            timer: 1500
            })
        </script>
    <?php
}
if(isset($_GET['announceSaved'])){
    ?>
        <script>
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Annoucement Sent!',
            showConfirmButton: false,
            timer: 1500
            })
        </script>
    <?php
}
if(isset($_GET['profileUpdated'])){
    ?>
        <script>
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Profile Updated!',
            showConfirmButton: false,
            timer: 1500
            })
        </script>
    <?php
}
?>
