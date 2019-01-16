<?php
echo "inside func.php </br>";
require('waConnect.php');

$action = filter_input(INPUT_POST, 'action');
$eventNumber = filter_input(INPUT_POST, 'eventNumber');
$eventType = filter_input(INPUT_POST, 'eventType');
echo $action;
echo "</br>";
echo $eventNumber;
echo "</br>";
echo $eventType;
echo "</br>";

if ($action == NULL) {
    echo "POST == NULL </br>";
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        echo "GET == NULL </br>";
        $error = 'Something went terribly wrong.';
        include('error.php');
    }
     if ($action == "getEventName") {
        echo "inside getEventName </br>";
        $eventNumber = filter_input(INPUT_POST, 'eventNumber', FILTER_VALIDATE_INT);
        $eventType = filter_input(INPUT_POST, 'eventType', FILTER_VALIDATE_INT);
        echo("eventNumber = " . $eventNumber);
        echo("eventType = " . $eventType);
        include('error.php');
//        if (empty($_POST['eventNumber'])) {
//            $this->HandleError("Last Name is empty!");
//            return false;
//        }
//        if (empty($_POST['eventType'])) {
//            $this->HandleError("Last Name is empty!");
//            return false;
//        }
    }

//    function Login() {
//        if (empty($_POST['lastName'])) {
//            $this->HandleError("Last Name is empty!");
//            return false;
//        }
//
//        if (empty($_POST['ssn'])) {
//            $this->HandleError("Last 4 of SSN is empty!");
//            return false;
//        }
//
//        $lastName = trim($_POST['lastName']);
//        $ssn = trim($_POST['ssn']);
//
//        if (!$this->CheckLoginInDB($lastName, $ssn)) {
//            return false;
//        }
//
//        session_start();
//
//        $_SESSION[$this->GetLoginSessionVar()] = $lastName;
//
//        return true;
//    }
//    if ($action == 'change_date') {
//        $image_id = filter_input(INPUT_GET, 'image_id', FILTER_VALIDATE_INT);
//        $journal_id = filter_input(INPUT_GET, 'journal_id', FILTER_VALIDATE_INT);
//        if ($image_id == NULL || $image_id == FALSE) {
//            $image_id = 1;
//        }
//        if ($journal_id == NULL || $journal_id == FALSE) {
//            $journal_id = 1;
//        }
//        $entry_dates = get_entry_dates_by_journal($journal_id);
//        $image_name = get_image_by_image_id($image_id);
//        $entry_data = get_entry_data_by_image_id($image_id);
//        $left_page_entries = get_left_page_entries_by_image_id($image_id);
//        $right_page_entries = get_right_page_entries_by_image_id($image_id);
//        include('read_entries.php');
//    }
//    if ($_POST["lastName"] || $_POST["ssn"]) {
//        echo "Welcome: " . $_POST["lastName"] . "<br />";
//        echo "Your Email is: " . $_POST["ssn"];
//    }

    if ($action === 'clientLogin') {

        $tsql = "SELECT P.[LastName]
                ,P.[FirstName]
                  FROM [beta_torresmartinez].[PersonModule].[Person] P
                  JOIN [beta_torresmartinez].[PersonSSNModule].[Person] S
                  ON P.[PersonID] = S.[PersonID]
                  WHERE RIGHT(SSN,4) = " . $_POST["ssn"];

        $stmt = sqlsrv_query($conn, $tsql);
        if ($stmt == false) {
            echo "Error in query preparation/execution.\n";
            die(print_r(sqlsrv_errors(), true));
        }

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $echo = "Welcome " . $row['FirstName'] . " " . $row['LastName'] . "\n";
            include('error.php');
        }
    }
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}