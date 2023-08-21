<?php
    // For session name
    $accountID=$_SESSION['accountID'];
    $infoUser = $pdo->query("SELECT * FROM account_information WHERE accountID = '$accountID'")->fetch();
?>