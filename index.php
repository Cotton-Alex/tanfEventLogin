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
    echo "index.verifyEmployee";
    $lastName = filter_input(INPUT_POST, 'lastName');
    $idNumber = filter_input(INPUT_POST, 'idNumber');
    staff_login($lastName, $idNumber);
    
    
} else if ($action == "getEventInfo") {
    echo "index.getEventInfo";
    $eventId = filter_input(INPUT_POST, 'eventId', FILTER_VALIDATE_INT);
    $eventType = filter_input(INPUT_POST, 'eventType', FILTER_VALIDATE_INT);
    echo $eventId;
    echo $eventType;
    if (empty($_POST['eventId'])) {      
        $this->HandleError("Event ID is empty!");
        return false;
    }
    elseif (empty($_POST['eventType'])) {
        $this->HandleError("Event type is empty!");
        return false;
    }
    if ($eventType == 1) {
        echo "index.getEventInfo.eventType==1";
        $_SESSION["eventType"] = $eventType;
        echo $_SESSION["eventType"];
        echo $eventType;
        echo $eventId;
        single_event_info($eventId, $eventType);
    }
    elseif ($eventType == 2) {
        echo "index.getEventInfo.eventType==2";
        $_SESSION["eventType"] = $eventType;
        echo $_SESSION["eventType"];
        echo $eventType;
        echo $eventId;
        multi_event_info($eventId, $eventType);
    }
    else {
        echo "index.getEventInfo.last_else You shouldn't be here!!!";
        return;
    }
    
} else if ($action == "clientLogin") {
    echo "index.clientLogin";
    $clientLastName = filter_input(INPUT_POST, 'clientLastName');
    $clientSSN = filter_input(INPUT_POST, 'clientSSN');
    if (empty($_POST['clientLastName'])) {
        echo "Last name is empty!";
        return false;
    }
    if (empty($_POST['clientSSN'])) {
        echo "SSN name is empty!";
        return false;
    }
    client_login($clientLastName, $clientSSN);
    //$action = 'client_attendance';

    $sessionHouseholdId = $_SESSION["dbHouseholdId"];
    $sessionEventId = $_SESSION["eventId"];
//    $householdMembers = get_household_members($dbHouseholdId);
//    echo $householdMembers;
    echo $sessionHouseholdId . "<br>";
    echo $sessionEventId;
    include ('client_attendance.php');
    
    
} else if ($action == 'clientAttendee') {
    echo "index.clientAttendee" . "<br>";
    $sessionEventType = $_SESSION["eventType"];
    $sessionEventId = $_SESSION["eventId"];
    $householdMemberAttended = filter_input(INPUT_POST, 'clientAttended', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
    echo $sessionEventType . "<br>";
    echo $sessionEventId . "<br>";
    if ($householdMemberAttended !== NULL) {
        if ($sessionEventType == 1) {
            foreach ($householdMemberAttended as $key => $value) {
                singleEventUpdateAttendance($sessionEventId, $value);
            }
        } else if ($sessionEventType == 2) {
            foreach ($householdMemberAttended as $key => $value) {
                multiEventUpdateAttendance($sessionEventId, $value);
            }
        }
    } else {
        echo "No household members selected.";
    }
}