<?php
// Index page alert
if(isset($_GET['warningLogin1'])){
    ?>
        <script>
            swal({
                title: "Empty Field",
                text: "Please input username and password!",
                icon: "error",
                button: "Close",
            });
        </script>
    <?php
}
if(isset($_GET['warningLogin2'])){
    ?>
        <script>
            swal({
                title: "Empty Username",
                text: "Please input username!",
                icon: "error",
                button: "Close",
            });
        </script>
    <?php
}
if(isset($_GET['warningLogin3'])){
    ?>
        <script>
            swal({
                title: "Empty Password",
                text: "Please input password!",
                icon: "error",
                button: "Close",
            });
        </script>
    <?php
}
if(isset($_GET['warningLogin4'])){
    ?>
        <script>
            swal({
                title: "Incorrect Username and Password",
                text: "Please input correct username and password!",
                icon: "error",
                button: "Close",
            });
        </script>
    <?php
}

// Welcome Dashboard Sweet Alert
if(isset($_GET['loginSuccess'])){
    ?>
        <script>
            swal({
                title: "Welcome Admin!",
                // text: "You clicked the button!",
                icon: "success",
                button: "Close",
            });
        </script>
    <?php
}


?>
