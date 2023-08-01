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
    $position = 'teacher';
    $status = 'active';

    $addquery = "INSERT INTO account_information (firstname, middlename, lastname, username, password, faculty, position, status)
        VALUES (?,?,?,?,?,?,?,?)";

    $stmt = $pdo->prepare($addquery);
    $stmt->execute([$firstname, $middlename, $lastname, $username, $password, $faculty, $position, $status]);

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
                'schedule' => $sched
            ];
        } else {
            break; // Stop the loop if any of the required fields are empty
        }
    }
    if (!empty($teacherData)) {
        // Prepare the query for multiple inserts
        $addSectionQuery = "INSERT INTO teacher_handle (accountID, schoolYear, section, subject, schedule)
                            VALUES (:accountID, :schoolYear, :section, :subject, :schedule)";

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
                'schedule' => $sched
            ];
        } else {
            break; // Stop the loop if any of the required fields are empty
        }
    }

    if (!empty($teacherData)) {
        // Prepare the query for multiple inserts
        $addSectionQuery = "INSERT INTO teacher_handle (accountID, schoolYear, section, subject, schedule)
                            VALUES (:accountID, :schoolYear, :section, :subject, :schedule)";
    
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

    $updatequery = "UPDATE account_information 
    SET firstname=?, middlename=?, lastname=?, username=?, password=?,faculty=?
    WHERE accountID=?";

    $stmt = $pdo->prepare($updatequery);
    $stmt->execute([$firstname, $middlename, $lastname, $username, $password, $faculty, $accountID]);
    
    // Update section handles
    $subjects = $_POST['subject'];
    $sections = $_POST['section'];
    $schedules = $_POST['schedule'];

    for ($i = 0; $i < count($handleIDs); $i++) {
        $handleID = $handleIDs[$i];
        $subject = $subjects[$i];
        $section = $sections[$i];
        $schedule = $schedules[$i];

        $updatehandle = "UPDATE teacher_handle SET schedule=?, section=?, subject=? WHERE accountID=? AND handleID=?";
        $stmt = $pdo->prepare($updatehandle);
        $stmt->execute([$schedule, $section, $subject, $accountID, $handleID]);
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
?>