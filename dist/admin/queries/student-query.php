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


// Edit Student
if(isset($_POST['editStudent'])){
    
    $studentID = $_POST['studentID'];
    $studentNumber = $_POST['studentNumber'];

    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];

    $studentBdate = $_POST['studentBdate'];
    $studentGender = $_POST['studentGender'];
    $studentSection = $_POST['studentSection'];
    $studentYear = $_POST['studentYear'];

    

    $updatequery = "UPDATE student 
    SET firstname=?, middlename=?, lastname=?, studentBdate=?, studentGender=?, studentSection=?, 
    studentYear=?, studentNumber=?
    WHERE studentID=?";

    $stmt = $pdo->prepare($updatequery);
    $stmt->execute([$firstname, $middlename, $lastname, $studentBdate, $studentGender, $studentSection, 
    $studentYear, $studentNumber, $studentID]);
    
    // Code for updating attendance records if there are records to update
    if (isset($_POST['attendanceID']) && isset($_POST['qrDate']) && isset($_POST['qrTime']) && isset($_POST['qrSubject'])) {
        $attendanceIDs = $_POST['attendanceID'];
        $qrDates = $_POST['qrDate'];
        $qrTimes = $_POST['qrTime'];
        $qrSubjects = $_POST['qrSubject'];

        for ($i = 0; $i < count($attendanceIDs); $i++) {
            $attendanceID = $attendanceIDs[$i];
            $qrDate = $qrDates[$i];
            $qrTime = $qrTimes[$i];
            $qrSubject = $qrSubjects[$i];

            $updatehandle = "UPDATE attendance_record SET qrDate=?, qrTime=?, qrSubject=? WHERE attendanceID=?";
            $stmt = $pdo->prepare($updatehandle);
            $stmt->execute([$qrDate, $qrTime, $qrSubject, $attendanceID]);
        }
    }

    header("Location: ../student.php?header=Student&updateStudentSuccess");
}


//Removed
if(isset($_GET['remove']) && isset($_GET['id'])){
    $studentID = $_GET['id'];
    $status = 'removed';
    $deactquery = "UPDATE student SET status=? WHERE studentID=?";

    $stmt = $pdo->prepare($deactquery);
    $stmt->execute([$status, $studentID]);
    header("Location: ../student.php?header=Student&removedTeacherSuccess");
}

//Restore
if(isset($_GET['restore']) && isset($_GET['id'])){
    $studentID = $_GET['id'];
    $status = '';
    $deactquery = "UPDATE student SET status=? WHERE studentID=?";

    $stmt = $pdo->prepare($deactquery);
    $stmt->execute([$status, $studentID]);
    header("Location: ../student.php?header=Student&restoreTeacherSuccess");
}
?>