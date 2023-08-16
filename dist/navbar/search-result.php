<?php
session_start();
include '../connection/db_conn.php';
include '../connection/session.php';
include '../connection/session_name.php';

$inputSearch = $_GET['inputSearch'];

$sql = "(SELECT firstname, middlename, lastname, accountID, position FROM account_information 
        WHERE position='teacher' AND (firstname LIKE :first_name OR middlename LIKE :middle_name OR lastname LIKE :last_name
        OR accountID LIKE :accountIDProf OR position LIKE :positionProf))
        UNION ALL
        (SELECT firstname, middlename, lastname, studentNumber, 'student' AS position FROM student 
        WHERE firstname LIKE :firstnameStud OR middlename LIKE :middlenameStud OR lastname LIKE :lastnameStud
        OR studentNumber LIKE :studentNumberStud OR 'student' LIKE :positionStud)";

// Bind parameters and execute the query
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':first_name', '%' . $inputSearch . '%', PDO::PARAM_STR);
$stmt->bindValue(':middle_name', '%' . $inputSearch . '%', PDO::PARAM_STR);
$stmt->bindValue(':last_name', '%' . $inputSearch . '%', PDO::PARAM_STR);
$stmt->bindValue(':accountIDProf', '%' . $inputSearch . '%', PDO::PARAM_STR);
$stmt->bindValue(':positionProf', '%' . $inputSearch . '%', PDO::PARAM_STR);

$stmt->bindValue(':firstnameStud', '%' . $inputSearch . '%', PDO::PARAM_STR);
$stmt->bindValue(':middlenameStud', '%' . $inputSearch . '%', PDO::PARAM_STR);
$stmt->bindValue(':lastnameStud', '%' . $inputSearch . '%', PDO::PARAM_STR);
$stmt->bindValue(':studentNumberStud', '%' . $inputSearch . '%', PDO::PARAM_STR);
$stmt->bindValue(':positionStud', '%' . $inputSearch . '%', PDO::PARAM_STR);
$stmt->execute();

// Fetch the results
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Count the total number of search results
$totalResults = count($results);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../connection/link.php'?>
    <title>Search Result</title>
</head>
<body>
    <!-- Topbar -->
    <?php include_once '../navbar/topbar.php'?>
    <!-- Sidebar -->
    <?php include_once '../navbar/sidebar.php'?>

    <br>
    <h3 class="headerSearch">Total Result: : <?php echo $totalResults?></h3>
    <br>
    <div class="search-main-container">
        <table id="searchResult" class="display">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Option</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $search) { 
                    $accountID = $search['accountID'];
                    $positionUser = $search['position'];

                    if($positionUser=='teacher'){
                        $path='teacher-view.php';
                        $id = $search['accountID'];
                        $studentNumber='';
                    }else{
                        $path='student-view.php';
                        // Student Name
                        $stmt = $pdo->prepare("SELECT * FROM student WHERE studentNumber = :studentNumber");
                        $stmt->bindParam(':studentNumber', $accountID, PDO::PARAM_INT);
                        $stmt->execute();
                        $student = $stmt->fetch(PDO::FETCH_ASSOC);

                        $id=$student['studentID'];
                        $studentNumber='studNum='.$student['studentNumber'];
                    }    
                ?>
               
                <tr>
                    <td><?php echo $search['accountID'];?></td>
                    <td><?php echo $search['firstname'].' '.$search['middlename'].' '.$search['lastname'] ?></td>
                    <td><?php echo $search['position'];?></td>
                    <td><a href="../admin/profile/<?php echo $path?>?header=<?php echo $search['firstname']?>'s Profile&id=<?php echo $id?>&<?php echo $studentNumber?>"><button class="view">Visit Profile</button></a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
<script>
    new DataTable('#searchResult');
</script>
</html>
