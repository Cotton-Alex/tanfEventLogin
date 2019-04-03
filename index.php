<?php session_start() ?>
<?php

//TODO: stop browser from remembering field inputs
// confirmation page for clients to double check list before submitting
require('model.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'staffLogin';
    }
}


if ($action == "staffLogin") {
    include ('staff_login.php');
    
    
} else if ($action == "verifyEmployee") {
    //echo "<br>debug enter i.verifyEmployee";
    $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_SPECIAL_CHARS);
    $idNumber = filter_input(INPUT_POST, 'idNumber', FILTER_VALIDATE_INT);
    if ($lastName == NULL || $lastName == FALSE ||
            $idNumber == NULL || $idNumber == FALSE) {
        $message = "Please enter your last name and ID number.";
        include ('staff_login.php');
    } else {
        $dbStaffLastName = staff_login($idNumber);
        if (strtolower($lastName) === strtolower($dbStaffLastName)) {
            include ('event_login.php');
        }
        if (strtolower($lastName) !== strtolower($dbStaffLastName)) {
            $message = "You've entered an invalid Name or ID number, please try again.";
            include ('staff_login.php');
        }
    }
    
    
} else if ($action == "getEventInfo") {
    //echo "<br>debug enter i.getEventInfo";
    $eventId = filter_input(INPUT_POST, 'eventId', FILTER_VALIDATE_INT);
    $eventType = filter_input(INPUT_POST, 'eventType', FILTER_VALIDATE_INT);
    if ($eventId == NULL || $eventId == FALSE ||
            $eventType == NULL || $eventType == FALSE) {
        $message = "Please enter your event number.";
        include ('event_login.php');
    } elseif ($eventType == 1) {
        //echo "<br>debug i.getEventInfo.eventType = " . $eventType;
        $_SESSION['eventType'] = $eventType;
        $singleEventInfo = single_event_info($eventId);
        $id = $singleEventInfo[0];
        $eventName = $singleEventInfo[1];
        $_SESSION['eventId'] = $id;
        $_SESSION['eventName'] = $eventName;
        //echo "<br>debug enter i.getEventInfo eventName = " . $eventName;
        //echo "<br>debug enter i.getEventInfo SESSION['eventName'] = " . $_SESSION['eventName'];
        if ($eventId === $id) {
            // Both OneTime and MultiSession events use $id to simplify later code
            $_SESSION["eventId"] = $id;
            include ('client_login.php');
        }
        if ($eventId !== $id) {
            $message = "There's no record of that event. Please double check your event ID.";
            include ('event_login.php');
        }
    } elseif ($eventType == 2) {
        //echo "<br>debug i.getEventInfo.eventType = " . $eventType;
        $_SESSION['eventType'] = $eventType;
        $multiSessionEventInfo = multi_event_info($eventId);
        $multiSessionEventId = $multiSessionEventInfo[0];
        $eventName = $multiSessionEventInfo[1];
        $id = $multiSessionEventInfo[2];
        $_SESSION['eventId'] = $id;
        $_SESSION['eventName'] = $eventName;
        if ($eventId === $multiSessionEventId) {
            // Both OneTime and MultiSession events use $id to simplify later code
            $_SESSION["eventId"] = $id;
            include ('client_login.php');
        }
        if ($eventId !== $multiSessionEventId) {
            $message = "There's no event scheduled for today with that ID.";
            include ('event_login.php');
        }
    } else {
        //echo "<br>debug i.getEventInfo.last_else";
        $message = "Something went wrong. ERROR CODE: 42";
        include ('event_login.php');
    }
    
    
} else if ($action == "clientLogin") {
    //echo "<br>debug enter i.clientLogin";
    $clientLastName = filter_input(INPUT_POST, 'clientLastName', FILTER_SANITIZE_SPECIAL_CHARS);
    $clientSSN = filter_input(INPUT_POST, 'clientSSN', FILTER_VALIDATE_INT);
    if ($clientLastName == NULL || $clientLastName == FALSE ||
            $clientSSN == NULL || $clientSSN == FALSE) {
        $message = "Please enter your last name and the last 4 digtis of your SSN.";
        include ('client_login.php');
    } else {
        $clientInfoArray =  client_login($clientSSN);
        $dbClientLastName = $clientInfoArray[0];
        $dbClientFirstName = $clientInfoArray[1];
        $dbPersonId = $clientInfoArray[2];
        $dbHouseholdId = $clientInfoArray[3];
        if (strtolower($clientLastName) == strtolower($dbClientLastName)) {
            //echo "<br>debug m.client_login input and db lastNames match";
//            $_SESSION["dbHouseholdId"] = $dbHouseholdId;
            $sessionHouseholdId = $dbHouseholdId;
            include ('client_attendance.php');
        } else {
            $message = "The information entered doesn't match any of our records. Please try again.";
            include ('client_login.php');
        }
    }
    
    
} else if ($action == 'clientAttendee') {
    //echo "<br>debug enter i.clientAttendee";
    $sessionEventType = $_SESSION["eventType"];
    $sessionEventId = $_SESSION["eventId"];
    $householdMemberAttended = filter_input(INPUT_POST, 'clientAttended', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
    //echo "<br>debug i.clientAttendee sessionEventType = " . $sessionEventType;
    //echo "<br>debug i.clientAttendee sessionEventId = " . $sessionEventId;
    if ($householdMemberAttended !== NULL) {
        if ($sessionEventType == 1) {
            foreach ($householdMemberAttended as $key => $value) {
                one_Time_Event_Update_Attendance_No_Duplicates($sessionEventId, $value);
                //header("location: client_login.php");
            }
            $attendanceCount = one_Time_Event_Attendee_Count($sessionEventId);
            include ('client_login.php');
        } else if ($sessionEventType == 2) {
            foreach ($householdMemberAttended as $key => $value) {
                multi_Event_Update_Attendance_No_Duplicates($sessionEventId, $value);
                //header("location: client_login.php");
            }
            $attendanceCount = multi_Event_Attendee_Count($sessionEventId);
            include ('client_login.php');
        }
    } else {
        $message = "No selection was made. Please try again.";
        include ('client_login.php');
    }
}  