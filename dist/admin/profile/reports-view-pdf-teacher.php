<?php
include '../../connection/db_conn.php';
$date_from = $_GET['date_from'];
$date_to = $_GET['date_to'];

if (!empty($date_from) && empty($date_to)) {
    // Totals
    $total_prof = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM account_information WHERE position='teacher' AND dateAdded = '$date_from'")->fetchColumn();

    // Fetch login_act table and student table
    $stmt = $pdo->prepare("SELECT * FROM account_information WHERE position='teacher' AND dateAdded = '$date_from'");
    $stmt->execute();
    $teacherGet = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
}
if (!empty($date_from) && !empty($date_to)) { //WHEN BOTH DATE IS SELECTED
    // Totals
    $total_prof = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM account_information WHERE position='teacher' AND dateAdded >= '$date_from' AND dateAdded <= '$date_to'")->fetchColumn();

    // Fetch login_act table and student table
    $stmt = $pdo->prepare("SELECT * FROM account_information WHERE position='teacher' AND dateAdded >= '$date_from' AND dateAdded <= '$date_to'");
    $stmt->execute();
    $teacherGet = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
}
if (empty($date_from) && empty($date_to)) {
    // Totals
    $total_prof = $pdo->query("SELECT COALESCE(COUNT(*), 0) FROM account_information WHERE position='teacher'")->fetchColumn();

    // Fetch login_act table and student table
    $stmt = $pdo->prepare("SELECT * FROM account_information WHERE position='teacher'");
    $stmt->execute();
    $teacherGet = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

    <br><br>
    <div class="sub-header">
        <table class="sub-header-table">
            <td class="subHeaderLeft">
                <h3>Total Registered Teacher: <?php echo $total_prof?></h3>
            </td>
            <?php for($i=1; $i<=7; $i++){?>
            <td class="subHeaderEmpty"></td>
            <?php }?>
            <td class="subHeaderRight">
                <div class="date">
                    <p>Date From: <?php echo $date_from?></p>
                    <p>Date To: <?php echo $date_to?></p>
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
        <?php foreach($teacherGet as $teacher){?>
        <tbody> <!-- Move the <tbody> tag here -->
            <tr class="mainTableRight">
                <td><?php echo $teacher['accountID']?></td>
                <td><?php echo $teacher['firstname'] . ' ' . $teacher['middlename'] . ' ' . $teacher['lastname'];?></td>
                <td><?php echo $teacher['sex']?></td>   
                <td><?php echo $teacher['position']?></td>
                <td><?php echo $teacher['dateAdded']?></td>
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
</style>