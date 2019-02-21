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

function event_info($evendId, $eventType) {
    if ($eventType === 1) {
        $conn = db();
        $sql = "SELECT [TANFOneTimeEventManagementID] 
      ,[EventName]
      ,[EventDate]
      FROM [beta_torresmartinez].[TANFOneTimeEventManagementModule].[TANFOneTimeEventManagement]
      WHERE [TANFOneTimeEventManagementID] = " . $evendId;
        $stmt = sqlsrv_query($conn, $sql);
    }
    if ($eventType === 2) {
        $conn = db();
        $sql = "SELECT [TANFMultipleSessionEventID]
      ,[EventName]
      ,[SubmittedByID]
      FROM [beta_torresmartinez].[TANFMultipleSessionEventModule].[TANFMultipleSessionEvent]
      WHERE [TANFMultipleSessionEventID] = " . $evendId;
        $stmt = sqlsrv_query($conn, $sql);
    }
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

    include ('client_login.php');
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}

function client_login($clientLastName, $clientSSN) {
    $conn = db();
    $sql = "SELECT P.[LastName]
        ,P.[FirstName]
        ,S.[PersonID]
        ,H.[HouseholdID]
        FROM [beta_torresmartinez].[PersonModule].[Person] P
        JOIN [beta_torresmartinez].[PersonSSNModule].[Person] S
        ON P.[PersonID] = S.[PersonID]
        JOIN [beta_torresmartinez].[HouseholdModule].[HouseholdMember] H
        ON P.[PersonID] = H.[PersonID]
        WHERE RIGHT(SSN,4) = " . $clientSSN;
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
        //echo $dbClientFirstName . " " . $dbClientLastName . " PersonId = " . $dbPersonId . " HouseholdId = " . $dbHouseholdId;
        household_members($dbHouseholdId);
    }

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}

function household_members($dbHouseholdId) {
    $conn = db();
    $sql = "SELECT P.[LastName]
        ,P.[FirstName]
        ,P.[PersonID]
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
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        echo "Welcome " . $row['FirstName'] . " " . $row['LastName'] . "\n <br>";
    }
    /* Free statement and connection resources. */
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}
