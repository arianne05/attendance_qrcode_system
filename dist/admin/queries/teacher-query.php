<?php
include '../../connection/db_conn.php';

// add Teacher
if(isset($_POST['addTeacher'])){
    $firstname = $_POST['teacherFName'];
    $middlename = $_POST['teacherMName'];
    $lastname = $_POST['teacherLName'];
    $username = $_POST['teacherUName'];
    $password = $_POST['teacherPass'];
    $faculty = $_POST['teacherFaculty'];
    $sex = $_POST['teacherSex'];
    $position = 'teacher';
    $status = 'active';
    $dateAdded = date('Y-m-d');

    $addquery = "INSERT INTO account_information (firstname, middlename, lastname, username, password, faculty, position, status, sex, dateAdded)
        VALUES (?,?,?,?,?,?,?,?,?,?)";

    $stmt = $pdo->prepare($addquery);
    $stmt->execute([$firstname, $middlename, $lastname, $username, $password, $faculty, $position, $status, $sex, $dateAdded]);

    //Get the ID of the teacher for section handle
    $selectquery = $pdo->prepare("SELECT accountID FROM account_information WHERE username = :username");
    $selectquery->bindParam(':username', $username, PDO::PARAM_STR);
    $selectquery->execute();
    $accountID = $selectquery->fetchColumn();

    $teacherData = [];

    for ($i = 1; $i <= 10; $i++) {
        $schedFromHour = !empty($_POST['schedFromHour' . $i]) ? $_POST['schedFromHour' . $i] : null;
        $schedFromMin = !empty($_POST['schedFromMin' . $i]) ? $_POST['schedFromMin' . $i] : null;
        $schedFromPeriod = !empty($_POST['schedFromPeriod' . $i]) ? $_POST['schedFromPeriod' . $i] : null;

        $schedToHour = !empty($_POST['schedToHour' . $i]) ? $_POST['schedToHour' . $i] : null;
        $schedToMin = !empty($_POST['schedToMin' . $i]) ? $_POST['schedToMin' . $i] : null;
        $schedToPeriod = !empty($_POST['schedToPeriod' . $i]) ? $_POST['schedToPeriod' . $i] : null;

        $schedFromValue = $schedFromHour !== null ? $schedFromHour . ':' : '';
        $schedFromValue .= $schedFromMin !== null ? $schedFromMin . ' ' : '';
        $schedFromValue .= $schedFromPeriod !== null ? $schedFromPeriod : '';

        $schedToValue = $schedToHour !== null ? $schedToHour . ':' : '';
        $schedToValue .= $schedToMin !== null ? $schedToMin . ' ' : '';
        $schedToValue .= $schedToPeriod !== null ? $schedToPeriod : '';

        $teacherFromSchoolYear = !empty($_POST['teacherFromSchoolYear' . $i]) ? $_POST['teacherFromSchoolYear' . $i] : "";
        $teacherToSchoolYear = !empty($_POST['teacherToSchoolYear' . $i]) ? $_POST['teacherToSchoolYear' . $i] : "";
        $teacherGrade = !empty($_POST['teacherGrade' . $i]) ? $_POST['teacherGrade' . $i] : "";
        $teacherSection = !empty($_POST['teacherSection' . $i]) ? $_POST['teacherSection' . $i] : "";
        $subject = !empty($_POST['teacherSubject' . $i]) ? $_POST['teacherSubject' . $i] : "";

        $convertFromTime = strtotime($schedFromValue);
        $schedFrom= date('H:i:s', $convertFromTime);
        $convertToTime = strtotime($schedToValue);
        $schedTo= date('H:i:s', $convertToTime);

        if (!empty($schedFromValue) && !empty($schedToValue) && !empty($teacherFromSchoolYear) && !empty($teacherToSchoolYear) && !empty($teacherGrade) && !empty($teacherSection) && !empty($subject)) {
            $schoolYear = $teacherFromSchoolYear . '-' . $teacherToSchoolYear;
            $section = $teacherGrade . '-' . $teacherSection;
            $sched = $schedFromValue . '-' . $schedToValue;

            // Store the data for this section in the teacherData array
            $teacherData[] = [
                'accountID' => $accountID,
                'schoolYear' => $schoolYear,
                'section' => $section,
                'subject' => $subject,
                'schedule' => $sched,
                'schedFrom' => $schedFrom,
                'schedTo' => $schedTo
            ];
        } else {
            break; // Stop the loop if any of the required fields are empty
        }
    }
    if (!empty($teacherData)) {
        // Prepare the query for multiple inserts
        $addSectionQuery = "INSERT INTO teacher_handle (accountID, schoolYear, section, subject, schedule, schedFrom, schedTo)
                            VALUES (:accountID, :schoolYear, :section, :subject, :schedule, :schedFrom, :schedTo)";

        $stmt = $pdo->prepare($addSectionQuery);

        // Execute the query for each section's data
        foreach ($teacherData as $data) {
            $stmt->execute($data);
        }
    }
    header("Location: ../teacher.php?header=Teacher&addTeacherSuccess");
    
}

// Add Schedule
if(isset($_POST['addSchedule'])){
    $accountID=$_POST['accountID'];

    $teacherData = [];

    for ($i = 1; $i <= 10; $i++) {
        $schedFromHour = !empty($_POST['schedFromHour' . $i]) ? $_POST['schedFromHour' . $i] : null;
        $schedFromMin = !empty($_POST['schedFromMin' . $i]) ? $_POST['schedFromMin' . $i] : null;
        $schedFromPeriod = !empty($_POST['schedFromPeriod' . $i]) ? $_POST['schedFromPeriod' . $i] : null;

        $schedToHour = !empty($_POST['schedToHour' . $i]) ? $_POST['schedToHour' . $i] : null;
        $schedToMin = !empty($_POST['schedToMin' . $i]) ? $_POST['schedToMin' . $i] : null;
        $schedToPeriod = !empty($_POST['schedToPeriod' . $i]) ? $_POST['schedToPeriod' . $i] : null;

        $schedFromValue = $schedFromHour !== null ? $schedFromHour . ':' : '';
        $schedFromValue .= $schedFromMin !== null ? $schedFromMin . ' ' : '';
        $schedFromValue .= $schedFromPeriod !== null ? $schedFromPeriod : '';

        $schedToValue = $schedToHour !== null ? $schedToHour . ':' : '';
        $schedToValue .= $schedToMin !== null ? $schedToMin . ' ' : '';
        $schedToValue .= $schedToPeriod !== null ? $schedToPeriod : '';

        $teacherFromSchoolYear = !empty($_POST['teacherFromSchoolYear' . $i]) ? $_POST['teacherFromSchoolYear' . $i] : "";
        $teacherToSchoolYear = !empty($_POST['teacherToSchoolYear' . $i]) ? $_POST['teacherToSchoolYear' . $i] : "";
        $teacherGrade = !empty($_POST['teacherGrade' . $i]) ? $_POST['teacherGrade' . $i] : "";
        $teacherSection = !empty($_POST['teacherSection' . $i]) ? $_POST['teacherSection' . $i] : "";
        $subject = !empty($_POST['teacherSubject' . $i]) ? $_POST['teacherSubject' . $i] : "";

        $convertFromTime = strtotime($schedFromValue);
        $schedFrom= date('H:i:s', $convertFromTime);
        $convertToTime = strtotime($schedToValue);
        $schedTo= date('H:i:s', $convertToTime);

        if (!empty($schedFromValue) && !empty($schedToValue) && !empty($teacherFromSchoolYear) && !empty($teacherToSchoolYear) && !empty($teacherGrade) && !empty($teacherSection) && !empty($subject)) {
            $schoolYear = $teacherFromSchoolYear . '-' . $teacherToSchoolYear;
            $section = $teacherGrade . '-' . $teacherSection;
            $sched = $schedFromValue . '-' . $schedToValue;

            // Store the data for this section in the teacherData array
            $teacherData[] = [
                'accountID' => $accountID,
                'schoolYear' => $schoolYear,
                'section' => $section,
                'subject' => $subject,
                'schedule' => $sched,
                'schedFrom' => $schedFrom,
                'schedTo' => $schedTo
            ];
        } else {
            break; // Stop the loop if any of the required fields are empty
        }
    }

    if (!empty($teacherData)) {
        // Prepare the query for multiple inserts
        $addSectionQuery = "INSERT INTO teacher_handle (accountID, schoolYear, section, subject, schedule, schedFrom, schedTo)
                            VALUES (:accountID, :schoolYear, :section, :subject, :schedule, :schedFrom, :schedTo)";
    
        $stmt = $pdo->prepare($addSectionQuery);
    
        // Execute the query for each section's data
        foreach ($teacherData as $data) {
            $stmt->execute($data);
        }
    }
    // Fetch the teacher's first name
    $fetchTeacherQuery = "SELECT firstname FROM account_information WHERE accountID = :accountID";
    $fetchStmt = $pdo->prepare($fetchTeacherQuery);
    $fetchStmt->execute(['accountID' => $accountID]);

    // Get the first name from the result
    $teacher = $fetchStmt->fetch();
    $firstname = $teacher['firstname'];
    header("Location: ../profile/teacher-view.php?header={$firstname}'s Profile&id={$accountID}&updateSchedSuccess");
}

// Remove/Archive
if(isset($_GET['remove'])){
    $handleID = $_GET['handleID'];
    $status = 'archived';
    $archiveSched = "UPDATE teacher_handle SET status=? WHERE handleID=?";

    $stmt = $pdo->prepare($archiveSched);
    $stmt->execute([$status, $handleID]);

    // Fetch the teacher's first name and accountID using the handleID
    $fetchTeacherQuery = "SELECT * FROM account_information 
        INNER JOIN teacher_handle  ON account_information.accountID = teacher_handle.accountID
        WHERE teacher_handle.handleID = :handleID";
    $fetchStmt = $pdo->prepare($fetchTeacherQuery);
    $fetchStmt->execute(['handleID' => $handleID]);

    // Get the first name and accountID from the result
    $teacher = $fetchStmt->fetch();
    $firstname = $teacher['firstname'];
    $accountID = $teacher['accountID'];

    header("Location: ../profile/teacher-view.php?header={$firstname}'s Profile&id={$accountID}&removedSchedSuccess");
}


// Edit Teacher
if(isset($_POST['editTeacher'])){
    $accountID = $_POST['accountID'];
    $handleIDs = $_POST['handleID'];

    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $faculty = $_POST['faculty'];
    $sex = $_POST['teacherSex'];

    $updatequery = "UPDATE account_information 
    SET firstname=?, middlename=?, lastname=?, username=?, password=?,faculty=?, sex=?
    WHERE accountID=?";

    $stmt = $pdo->prepare($updatequery);
    $stmt->execute([$firstname, $middlename, $lastname, $username, $password, $faculty, $sex, $accountID]);
    
    // Update section handles
    $subjects = $_POST['subject'];
    $sections = $_POST['section'];
    $schedFroms = $_POST['schedFrom'];
    $schedTos = $_POST['schedTo'];

    for ($i = 0; $i < count($handleIDs); $i++) {
        $handleID = $handleIDs[$i];
        $subject = $subjects[$i];
        $section = $sections[$i];
        $schedFrom = $schedFroms[$i];
        $schedTo = $schedTos[$i];

        $updatehandle = "UPDATE teacher_handle SET schedFrom=?, schedTo=?, section=?, subject=? WHERE accountID=? AND handleID=?";
        $stmt = $pdo->prepare($updatehandle);
        $stmt->execute([$schedFrom, $schedTo, $section, $subject, $accountID, $handleID]);
    }

    header("Location: ../teacher.php?header=Teacher&updateTeacherSuccess");
}


//Deactivate
if(isset($_GET['deactivate']) && isset($_GET['id'])){
    $accountID = $_GET['id'];
    $status = 'inactive';
    $deactquery = "UPDATE account_information SET status=? WHERE accountID=?";

    $stmt = $pdo->prepare($deactquery);
    $stmt->execute([$status, $accountID]);
    header("Location: ../teacher.php?header=Teacher&deactTeacherSuccess");
}

//Activate
if(isset($_GET['activate']) && isset($_GET['id'])){
    $accountID = $_GET['id'];
    $status = 'active';
    $deactquery = "UPDATE account_information SET status=? WHERE accountID=?";

    $stmt = $pdo->prepare($deactquery);
    $stmt->execute([$status, $accountID]);
    header("Location: ../teacher.php?header=Teacher&actTeacherSuccess");
}

// Save Security Information
if(isset($_POST['saveSecurity'])){
    $accountID = $_POST['accountID'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $secQuestion = $_POST['secQuestion'];
    $secAnswer = $_POST['secAnswer'];
    
    if (empty($password) && empty($cpassword)) {
        header("Location: ../user-profile-security.php?header=My Profile&id=$accountID&emptyPassandCP");
        exit();
    } elseif (empty($cpassword)) {
        header("Location: ../user-profile-security.php?header=My Profile&id=$accountID&emptyCP");
        exit();
    } elseif ($password != $cpassword) {
        header("Location: ../user-profile-security.php?header=My Profile&id=$accountID&wrongCP");
        exit();
    } else {
        $updatequery = "UPDATE account_information 
                        SET username=?, password=?, secQuestion=?, secAnswer=? WHERE accountID=?";
    
        $stmt = $pdo->prepare($updatequery);
        $stmt->execute([$username, $password, $secQuestion, $secAnswer, $accountID]);
        header("Location: ../user-profile-security.php?header=My Profile&id=$accountID&securitySaved");
        exit();
    }
}

// Add Announcement
if(isset($_POST['addAnnounce'])){
    $accountID = $_POST['accountID'];
    $subject = $_POST['subject'];
    $description = $_POST['description'];
    $date = date("Y-m-d");
    $time = date("H:i:s");

    $addquery = "INSERT INTO announcement (accountID, subject, description, date, time)
        VALUES (?,?,?,?,?)";

    $stmt = $pdo->prepare($addquery);
    $stmt->execute([$accountID, $subject, $description, $date, $time]);
    header("Location: ../user-profile-announ.php?header=My Profile&id=$accountID&announceSaved");
}

// Update My Profile
if(isset($_POST['updateProfile'])){
    $accountID = $_POST['accountID'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $faculty = $_POST['faculty'];
    $dateAdded = $_POST['dateAdded'];
    
    $updatequery = "UPDATE account_information 
    SET firstname=?, middlename=?, lastname=?, username=?, faculty=?, dateAdded=?
    WHERE accountID=?";

    $stmt = $pdo->prepare($updatequery);
    $stmt->execute([$firstname, $middlename, $lastname, $username, $faculty, $dateAdded, $accountID]);

    header("Location: ../user-profile.php?header=My Profile&id=$accountID&profileUpdated");
}

// Remove/Archive Announcement
if(isset($_GET['removeAnnounce'])){
    $announceID = $_GET['id'];
    $status = 'removed';
    $archiveSched = "UPDATE announcement SET status=? WHERE announceID=?";

    $stmt = $pdo->prepare($archiveSched);
    $stmt->execute([$status, $announceID]);

    header("Location: ../announce.php?header=Announcement&removedAnnounceSuccess");
}

// Update Announcement
if(isset($_POST['updateAnnounce'])){
    $announceID = $_POST['announceID'];
    $subject = $_POST['subject'];
    $description = $_POST['description'];
    
    
    $updatequery = "UPDATE announcement 
    SET subject=?, description=?
    WHERE announceID=?";

    $stmt = $pdo->prepare($updatequery);
    $stmt->execute([$subject, $description, $announceID]);

    header("Location: ../profile/announce-content.php?header=Announcement&id=$announceID&view&profileAnnounceUpdated");
}

?>


