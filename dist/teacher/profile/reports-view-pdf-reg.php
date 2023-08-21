<?php
include '../../connection/db_conn.php';

$date_from = $_GET['date_from'];
$date_to = $_GET['date_to'];
$accountID= $_GET['accountID'];

if($date_from == ''){
    $date_from_display = 'NA';
}else{
    $date_from_display = $_GET['date_from'];
}
if($date_to == ''){
    $date_to_display = 'NA';
}else{
    $date_to_display = $_GET['date_to'];
}


if (!empty($date_from) && empty($date_to)) {
    // Totals
    $total_register_users = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM student WHERE accountID='$accountID' AND dateAdded = '$date_from'")->fetchColumn();
    $total_register_male = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM student WHERE accountID='$accountID' AND studentGender='Male' AND dateAdded = '$date_from'")->fetchColumn();
    $total_register_female = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM student WHERE accountID='$accountID' AND studentGender='Female' AND dateAdded = '$date_from'")->fetchColumn();
  
    // Fetch login_act table and student table
    $stmt = $pdo->prepare("SELECT * FROM student WHERE accountID='$accountID' AND dateAdded = '$date_from'");
    $stmt->execute();
    $fetchStudents = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Assuming $accountID is a safe and validated value from user input
    $stmt = $pdo->prepare("SELECT firstname, middlename, lastname FROM account_information WHERE accountID = :accountID");
    $stmt->bindParam(':accountID', $accountID, PDO::PARAM_INT); // Assuming accountID is an integer, adjust the data type accordingly if needed
    $stmt->execute();
    $nameData = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (!empty($date_from) && !empty($date_to)) { //WHEN BOTH DATE IS SELECTED
    // Totals
    $total_register_users = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM student WHERE accountID='$accountID' AND dateAdded >= '$date_from' AND dateAdded <= '$date_to'")->fetchColumn();
    $total_register_male = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM student WHERE accountID='$accountID' AND studentGender='Male' AND dateAdded >= '$date_from' AND dateAdded <= '$date_to'")->fetchColumn();
    $total_register_female = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM student WHERE accountID='$accountID' AND studentGender='Female' AND dateAdded >= '$date_from' AND dateAdded <= '$date_to'")->fetchColumn();
  
    // Fetch login_act table and student table
    $stmt = $pdo->prepare("SELECT * FROM student WHERE accountID='$accountID' AND dateAdded >= '$date_from' AND dateAdded <= '$date_to'");
    $stmt->execute();
    $fetchStudents = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Assuming $accountID is a safe and validated value from user input
    $stmt = $pdo->prepare("SELECT firstname, middlename, lastname FROM account_information WHERE accountID = :accountID");
    $stmt->bindParam(':accountID', $accountID, PDO::PARAM_INT); // Assuming accountID is an integer, adjust the data type accordingly if needed
    $stmt->execute();
    $nameData = $stmt->fetch(PDO::FETCH_ASSOC);
    
}

if (empty($date_from) && empty($date_to)) { //WHEN BOTH DATE IS EMPTY
    // Totals
    $total_register_users = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM student WHERE accountID='$accountID'")->fetchColumn();
    $total_register_male = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM student WHERE accountID='$accountID' AND studentGender='Male'")->fetchColumn();
    $total_register_female = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM student WHERE accountID='$accountID' AND studentGender='Female'")->fetchColumn();
  

    // Fetch login_act table and student table
    $stmt = $pdo->prepare("SELECT * FROM student WHERE accountID='$accountID'");
    $stmt->execute();
    $fetchStudents = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Assuming $accountID is a safe and validated value from user input
    $stmt = $pdo->prepare("SELECT firstname, middlename, lastname FROM account_information WHERE accountID = :accountID");
    $stmt->bindParam(':accountID', $accountID, PDO::PARAM_INT); // Assuming accountID is an integer, adjust the data type accordingly if needed
    $stmt->execute();
    $nameData = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="main-header">
        <table class="main-header-table">
            <td class="headerLeft">
                <img src="../../img/cvsu_logo.png" width="50" height="50">
            </td>
            <td class="headerRight">
                <div class="caption-main-header">
                    <p><b>Biclatan National Highschool</b></p>
                    <p>San Isidro Labrador I</p>
                    <p>Dasmarinas City Cavite</p>
                </div>
            </td>
        </table>
    </div>
    <center class="preparedBy">
        <br>
        <h3>Student Registration Reports</h3>
        <p>prepared by: <?php echo $nameData['firstname'].' '.$nameData['middlename'].' '.$nameData['lastname']?></p>
    </center>
    
    <br><br>
    <div class="sub-header">
        <table class="sub-header-table">
            <td class="subHeaderLeft">
                <h3>Total Users: <?php echo $total_register_users?></h3>
                <p>Total Male: <?php echo $total_register_male;?></p>
                <p>Total Female: <?php echo $total_register_female;?></p>
            </td>
            <?php for($i=1; $i<=7; $i++){?>
            <td class="subHeaderEmpty"></td>
            <?php }?>
            <td class="subHeaderRight">
                <div class="date">
                    <p>Date From: <?php echo $date_from_display?></p>
                    <p>Date To: <?php echo $date_to_display?></p>
                </div>
            </td>
        </table>
    </div>

    <br>
    <table class="main-table-user">
        <thead>
            <tr class="mainTableLeft">
                <th>ID Number</th>
                <th>Name</th>
                <th>Sex</th>
                <th>Position</th>
                <th>Date Added</th>
            </tr>
        </thead>
        <?php foreach($fetchStudents as $student){?>
        <tbody> <!-- Move the <tbody> tag here -->
            <tr class="mainTableRight">
                <td><?php echo $student['studentNumber']?></td>
                <td><?php echo $student['firstname'] . ' ' . $student['middlename'] . ' ' . $student['lastname'];?></td>
                <td><?php echo $student['studentGender']?></td>   
                <td><?php echo $student['studentYear']?></td>
                <td><?php echo $student['dateAdded']?></td>
            </tr>
        </tbody>
        <?php } ?>
    </table>
</body>
</html>

<style>
    .main-header{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .caption-main-header p{
        padding: 0;
        margin: 0;
    }
    .main-header-table{
        margin: 0 auto;
        border-collapse: collapse;
        border: none;
    }
    .headerRight{
        text-align: center;
        border: none;
    }
    .headerLeft{
        text-align: right;
        border: none;
    }


    .sub-header-table{
        width: 100%;
        padding: 0;
        border-collapse: collapse;
    }
    .subHeaderRight{
        margin: 0;
        padding: 0;
        text-align: left;
        border: none;
    }
    .subHeaderLeft{
        margin: 0;
        padding: 0;
        border: none;
    }
    .subHeaderEmpty{
        padding-right: 20px;
        border: none;
    }
    .subHeaderLeft h3{
        margin: 0;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .subHeaderLeft p{
        margin: 0;
        padding: 0;
    }
    .date p{
        padding: 0;
        margin: 0;
    }

    .main-table-user{
        width: 100%;
        padding: 7px;
    }
    .main-table-user thead{
        border-bottom: 2px solid black;
    }
    .mainTableLeft th{
        text-align: left;
        padding: 5px;
    }
    .mainTableRight td{
        padding: 5px;
    }
    .preparedBy p, h3{
        margin: 0;
        padding: 0;
    }
</style>