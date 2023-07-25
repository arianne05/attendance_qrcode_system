<?php
if (!isset($_SESSION['accountID'])) {
    // Redirect the user to the login page
    header("Location: ../index.php?errorSession");
    exit();
}
?>