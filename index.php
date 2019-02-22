<?php session_start() ?>
<?php
//TODO: stop browser from remembering field inputs

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
//    echo("eventId = " . $eventId);
//    echo("<br>");
//    echo("eventType = " . $eventType);
    //include('error.php');
    if (empty($_POST['eventId'])) {
        $this->HandleError("Event ID is empty!");
        return false;
    }
    if (empty($_POST['eventType'])) {
        $this->HandleError("Event type is empty!");
        return false;
    }
    event_info($eventId, $eventType);

}  else if ($action == "clientLogin") {
    $clientLastName = filter_input(INPUT_POST, 'clientLastName');
    $clientSSN = filter_input(INPUT_POST, 'clientSSN');
//    echo ("1 <br>");
    if (empty($_POST['clientLastName'])) {
        $this->HandleError("Last name is empty!");
        return false;
    }
    if (empty($_POST['clientSSN'])) {
        $this->HandleError("SSN is empty!");
        return false;
    }
//    echo ("2 <br>");
    client_login($clientLastName, $clientSSN);
    echo ("11 <br>");
    echo ($dbHouseholdId);
    echo ("12 <br>");
    $action = 'client_attendance';
    
//}else if ($action == 'client_attendance') {
//    echo ($action);
    $dbHouseholdId = $_SESSION["dbHouseholdId"];
    $householdMembers = get_household_members($dbHouseholdId);
    include ('client_attendance.php');
}

  
//} else if ($action == "clientLogin") {
//    $clientLastName = filter_input(INPUT_POST, 'clientLastName');
//    $clientSSN = filter_input(INPUT_POST, 'clientSSN');
//    if (empty($_POST['clientLastName'])) {
//        $this->HandleError("Last name is empty!");
//        return false;
//    }
//    if (empty($_POST['clientSSN'])) {
//        $this->HandleError("SSN is empty!");
//        return false;
//    }
//    client_login($clientLastName, $clientSSN);
//    
//    
//} 
else if ($action == 'change_date') {
    $image_id = filter_input(INPUT_GET, 'image_id', FILTER_VALIDATE_INT);
    $journal_id = filter_input(INPUT_GET, 'journal_id', FILTER_VALIDATE_INT);
    if ($image_id == NULL || $image_id == FALSE) {
        $image_id = 1;
    }
    if ($journal_id == NULL || $journal_id == FALSE) {
        $journal_id = 1;
    }
    $entry_dates = get_entry_dates_by_journal($journal_id);
    $image_name = get_image_by_image_id($image_id);
    $entry_data = get_entry_data_by_image_id($image_id);
    $left_page_entries = get_left_page_entries_by_image_id($image_id);
    $right_page_entries = get_right_page_entries_by_image_id($image_id);
    include('read_entries.php');
}
//sqlsrv_free_stmt($stmt);
//sqlsrv_close($conn);


