<?php

//http://php.net/manual/en/ref.sqlsrv.php

function db() {
// TODO: Is there a more secure way to connect to the db?
    //$serverName = "DESKTOP-LF2D9SR\SQLEXPRESS"; //HOME
    $serverName = "TH-B03-VMWKS07\SQLEXPRESS";  //WORK
    $connectionInfo = array("Database" => "beta_torresmartinez");
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    if ($conn == false) {
        echo "Conn error\n";
        die(print_r(sqlsrv_errors(), true));
    }
    return $conn;
}

function staff_login($lastName, $idNumber) {
    $conn = db();
    $sql = "SELECT [StaffID]
        ,[FirstName]
        ,[LastName]
        FROM [beta_torresmartinez].[StaffModule].[Staff]
        WHERE [StaffID] = " . $idNumber;
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt == false) {
        echo "Error in query preparation/execution.\n";
        die(print_r(sqlsrv_errors(), true));
    }
    if (sqlsrv_fetch($stmt) == false) { // Make the first (and in this case, only) row of the result set available for reading.
        die(print_r(sqlsrv_errors(), true));
    }
    $id = sqlsrv_get_field($stmt, 0);
    $dbStaffFirstName = sqlsrv_get_field($stmt, 1);
    $dbStaffLastName = sqlsrv_get_field($stmt, 2);
    if ($lastName === $dbStaffLastName) {
        include ('event_login.php');
    }
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}

function single_event_info($eventId, $eventType) {
    $conn = db();
    $sql = "SELECT [TANFOneTimeEventManagementID] 
      ,[EventName]
      ,[EventDate]
      FROM [beta_torresmartinez].[TANFOneTimeEventManagementModule].[TANFOneTimeEventManagement]
      WHERE [TANFOneTimeEventManagementID] = " . $eventId;
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt == false) {
        echo "Error in query preparation/execution.\n";
        die(print_r(sqlsrv_errors(), true));
    }
    if (sqlsrv_fetch($stmt) == false) { // Make the first (and in this case, only) row of the result set available for reading.
        die(print_r(sqlsrv_errors(), true));
    }
    $id = sqlsrv_get_field($stmt, 0);
    $eventName = sqlsrv_get_field($stmt, 1);
    $eventDate = sqlsrv_get_field($stmt, 2);
    $_SESSION["eventId"] = $id;
    include ('client_login.php');
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}

function multi_event_info($eventId, $eventType) {
    $conn = db();
    $sql = "SELECT S.[MultipleSessionEventSessionID]
      ,E.[EventName]
      ,S.[TANFMultipleSessionEventID]
      ,S.[StartDate]
      FROM [beta_torresmartinez].[TANFMultipleSessionEventModule].[MultipleSessionEventSession] S
      JOIN [beta_torresmartinez].[TANFMultipleSessionEventModule].[TANFMultipleSessionEvent] E
      ON S.[TANFMultipleSessionEventID] = E.[TANFMultipleSessionEventID]
      WHERE S.[TANFMultipleSessionEventID] = " . $eventId .
            "AND   DATEPART(yyyy, StartDate) = " . date('Y') .
            "AND   DATEPART(mm, StartDate) = " . date('m') .
            "AND   DATEPART(dd, StartDate) = " . date('d');
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt == false) {
        echo "Error in query preparation/execution.\n";
        die(print_r(sqlsrv_errors(), true));
    }
    if (sqlsrv_fetch($stmt) == false) { // Make the first (and in this case, only) row of the result set available for reading.
        echo "There is no event with that ID scheduled for today.<br>"
        . "Please double check your event number and try again.<br>";
        header("Location: event_login.php");
    }
    if (sqlsrv_get_field($stmt, 0) == NULL) {
        echo "There is no event with that ID scheduled for today.";
        include ('event_login.php');
    }
    $id = sqlsrv_get_field($stmt, 0);
    $eventName = sqlsrv_get_field($stmt, 1);
    $sessionEventId = sqlsrv_get_field($stmt, 2);
    $_SESSION["eventId"] = $id;
    include ('client_login.php');
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}

function client_login($clientLastName, $clientSSN) {
    $conn = db();
    $sql = "SELECT P.[LastName]
, P.[FirstName]
, S.[PersonID]
, H.[HouseholdID]
FROM [beta_torresmartinez].[PersonModule].[Person] P
JOIN [beta_torresmartinez].[PersonSSNModule].[Person] S
ON P.[PersonID] = S.[PersonID]
JOIN [beta_torresmartinez].[HouseholdModule].[HouseholdMember] H
ON P.[PersonID] = H.[PersonID]
WHERE RIGHT(SSN, 4) = " . $clientSSN;
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt == false) {
        echo "Error in query preparation/execution.\n";
        die(print_r(sqlsrv_errors(), true));
    }
    if (sqlsrv_fetch($stmt) == false) { // Make the first (and in this case, only) row of the result set available for reading.
        die(print_r(sqlsrv_errors(), true));
    }
    $dbClientLastName = sqlsrv_get_field($stmt, 0);
    $dbClientFirstName = sqlsrv_get_field($stmt, 1);
    $dbPersonId = sqlsrv_get_field($stmt, 2);
    $dbHouseholdId = sqlsrv_get_field($stmt, 3);

    if ($clientLastName === $dbClientLastName) {
        $_SESSION["dbHouseholdId"] = $dbHouseholdId;
//echo "Session variable dbHouseholdId = " . $_SESSION["dbHouseholdId"] . "<br>";
//get_household_members($dbHouseholdId);
    }
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
    return; // $dbHouseholdId;
}

function get_household_members($dbHouseholdId) {
    $conn = db();
    $sql = "SELECT P.[LastName]
, P.[FirstName]
, P.[PersonID]
FROM [beta_torresmartinez].[PersonModule].[Person] P
JOIN [beta_torresmartinez].[HouseholdModule].[HouseholdMember] H
ON P.[PersonID] = H.[PersonID]
WHERE [HouseholdID] = " . $dbHouseholdId;
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt == false) {
        echo "Error in query preparation/execution.\n";
        die(print_r(sqlsrv_errors(), true));
    }
    /* Retrieve each row as an associative array and display the results. */

    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_BOTH)) {
//echo "Welcome " . $row['FirstName'] . " " . $row['LastName'] . "\n <br>";
        echo ("<input type = 'checkbox' name = 'clientAttended[]' value = " . $row['PersonID'] . " maxlength = '3'/> " . $row['FirstName'] . " " . $row['LastName'] . "<br>");
    }
    /* Free statement and connection resources. */
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
    return;
}

function singleEventUpdateAttendance($sessionEventId, $attendeeId) {
    $conn = db();
    $sql = "INSERT INTO [beta_torresmartinez].[TANFOneTimeEventManagementModule].[OneTimeEventRegistrant] (TANFOneTimeEventManagementID, RegistrantID, Attended)
VALUES (?, ?, ?)";
    $params = array($sessionEventId, $attendeeId, "1");
    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    /* Free statement and connection resources. */
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
    return;
}

function multiEventUpdateAttendance($sessionEventId, $attendeeId) {
    $conn = db();
    $sql = "INSERT INTO [beta_torresmartinez].[TANFMultipleSessionEventModule].[MultipleSessionEventSessionAttendee] (MultipleSessionEventSessionID, PersonID, Attended) 
VALUES (?, ?, ?)";
    $params = array($sessionEventId, $attendeeId, "1");
    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    /* Free statement and connection resources. */
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
    return;
}
