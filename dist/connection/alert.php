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


?>
