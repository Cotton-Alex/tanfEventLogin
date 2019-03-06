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
    $lastName = filter_input(INPUT_POST, 'lastName');
    $idNumber = filter_input(INPUT_POST, 'idNumber');
    staff_login($lastName, $idNumber);
    
    
} else if ($action == "getEventName") {
    $eventId = filter_input(INPUT_POST, 'eventId', FILTER_VALIDATE_INT);
    $eventType = filter_input(INPUT_POST, 'eventType', FILTER_VALIDATE_INT);
    if (empty($_POST['eventId'])) {
        $this->HandleError("Event ID is empty!");
        return false;
    }
    if (empty($_POST['eventType'])) {
        $this->HandleError("Event type is empty!");
        return false;
    }
    if ($eventType == 1) {
        $_SESSION["eventType"] = $eventType;
        single_event_info($eventId, $eventType);
    }
    if ($eventType == 2) {
        $_SESSION["eventType"] = $eventType;
        multi_event_info($eventId, $eventType);
    }
    
    
} else if ($action == "clientLogin") {
    $clientLastName = filter_input(INPUT_POST, 'clientLastName');
    $clientSSN = filter_input(INPUT_POST, 'clientSSN');
    if (empty($_POST['clientLastName'])) {
        $this->HandleError("Last name is empty!");
        return false;
    }
    if (empty($_POST['clientSSN'])) {
        $this->HandleError("SSN is empty!");
        return false;
    }
    client_login($clientLastName, $clientSSN);
    //$action = 'client_attendance';

    $sessionHouseholdId = $_SESSION["dbHouseholdId"];
    $sessionEventId = $_SESSION["eventId"];
//    $householdMembers = get_household_members($dbHouseholdId);
//    echo $householdMembers;
    echo $sessionHouseholdId;
    echo $sessionEventId;
    include ('client_attendance.php');
    
    
} else if ($action == 'clientAttendee') {
    $sessionEventType = $_SESSION["eventType"];
    $sessionEventId = $_SESSION["eventId"];
    $householdMemberAttended = filter_input(INPUT_POST, 'clientAttended', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
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