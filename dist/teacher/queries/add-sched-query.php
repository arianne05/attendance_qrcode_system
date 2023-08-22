<?php
include '../../connection/db_conn.php';

// Add Schedule
if(isset($_POST['addScheduleTeacher'])){
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
    
    header("Location: ../attendance.php?header=Attendance&updateSchedSuccess");
}

// Remove/Archive Schedule
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
    header("Location: ../attendance.php?header=Attendance&removedSchedSuccess");
}
?>