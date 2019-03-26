<?php

//http://php.net/manual/en/ref.sqlsrv.php

function db() {
    //echo " inside conn <br>";
// TODO: Is there a more secure way to connect to the db?
    //$serverName = "DESKTOP-LF2D9SR\SQLEXPRESS"; //HOME
    $serverName = "TH-B03-VMWKS07\SQLEXPRESS";  //WORK
    $connectionInfo = array("Database" => "beta_torresmartinez");
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    if ($conn === false) {
        echo "Conn error\n";
        die(print_r(sqlsrv_errors(), true));
    }
    //echo " end of conn <br>";
    return $conn;
}

function staff_login($idNumber) {
    $conn = db();
    $sql = "SELECT [LastName]
        FROM [beta_torresmartinez].[StaffModule].[Staff]
        WHERE [StaffID] = " . $idNumber;
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        echo "Error in query preparation/execution.\n";
        die(print_r(sqlsrv_errors(), true));
    } if (sqlsrv_fetch($stmt) === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $dbStaffLastName = sqlsrv_get_field($stmt, 0);
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
    return $dbStaffLastName;
}

function single_event_info_id($eventId) {
    echo "model.single_event_info_id";
    echo $eventId;
    $conn = db();
    $sql = "SELECT [TANFOneTimeEventManagementID] 
      ,[EventName]
      ,[EventDate]
      FROM [beta_torresmartinez].[TANFOneTimeEventManagementModule].[TANFOneTimeEventManagement]
      WHERE [TANFOneTimeEventManagementID] = " . $eventId .
            " AND   DATEPART(yyyy, EventDate) = " . date('Y') .
            " AND   DATEPART(mm, EventDate) = " . date('m') .
            " AND   DATEPART(dd, EventDate) = " . date('d');
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        echo "Error in query preparation/execution.\n";
        die(print_r(sqlsrv_errors(), true));
    } if (sqlsrv_fetch($stmt) === false) { 
        die(print_r(sqlsrv_errors(), true));
    } else {
        $id = sqlsrv_get_field($stmt, 0);
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
        return $id;
    }
}

function single_event_info_name($eventId) {
    echo "model.single_event_info_name";
    $conn = db();
    $sql = "SELECT [TANFOneTimeEventManagementID] 
      ,[EventName]
      ,[EventDate]
      FROM [beta_torresmartinez].[TANFOneTimeEventManagementModule].[TANFOneTimeEventManagement]
      WHERE [TANFOneTimeEventManagementID] = " . $eventId .
            " AND   DATEPART(yyyy, EventDate) = " . date('Y') .
            " AND   DATEPART(mm, EventDate) = " . date('m') .
            " AND   DATEPART(dd, EventDate) = " . date('d');
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        echo "Error in query preparation/execution.\n";
        die(print_r(sqlsrv_errors(), true));
    } if (sqlsrv_fetch($stmt) === false) { 
        die(print_r(sqlsrv_errors(), true));
    } else {
        $eventName = sqlsrv_get_field($stmt, 1);
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
        return $eventName;
    }
}

function multi_event_info_multiSessionEventId($eventId) {
    echo "model.multi_event_info<br>";
    $conn = db();
    $sql = "SELECT S.TANFMultipleSessionEventID
        , E.EventName
        , S.MultipleSessionEventSessionID
        , S.StartDate
      FROM beta_torresmartinez.TANFMultipleSessionEventModule.TANFMultipleSessionEvent AS E
      JOIN beta_torresmartinez.TANFMultipleSessionEventModule.MultipleSessionEventSession AS S
      ON (S.TANFMultipleSessionEventID = E.TANFMultipleSessionEventID)
      WHERE S.TANFMultipleSessionEventID = " . $eventId .
            "AND   DATEPART(yyyy, StartDate) = " . date('Y') .
            "AND   DATEPART(mm, StartDate) = " . date('m') .
            "AND   DATEPART(dd, StartDate) = " . date('d');
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        echo "Error in query preparation/execution.\n";
        die(print_r(sqlsrv_errors(), true));
    }elseif (sqlsrv_fetch($stmt) === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        echo "model.multi_event_info after if false<br>";
        $multiSessionEventId = sqlsrv_get_field($stmt, 0);
        $eventName = sqlsrv_get_field($stmt, 1);
        $id = sqlsrv_get_field($stmt, 2);
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
        return $multiSessionEventId;
    }
}

function multi_event_info_name($eventId) {
    echo "model.multi_event_info<br>";
    $conn = db();
    $sql = "SELECT S.TANFMultipleSessionEventID
        , E.EventName
        , S.MultipleSessionEventSessionID
        , S.StartDate
      FROM beta_torresmartinez.TANFMultipleSessionEventModule.TANFMultipleSessionEvent AS E
      JOIN beta_torresmartinez.TANFMultipleSessionEventModule.MultipleSessionEventSession AS S
      ON (S.TANFMultipleSessionEventID = E.TANFMultipleSessionEventID)
      WHERE S.TANFMultipleSessionEventID = " . $eventId .
            "AND   DATEPART(yyyy, StartDate) = " . date('Y') .
            "AND   DATEPART(mm, StartDate) = " . date('m') .
            "AND   DATEPART(dd, StartDate) = " . date('d');
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        echo "Error in query preparation/execution.\n";
        die(print_r(sqlsrv_errors(), true));
    }elseif (sqlsrv_fetch($stmt) === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        echo "model.multi_event_info after if false<br>";
        $sessionEventId = sqlsrv_get_field($stmt, 0);
        $eventName = sqlsrv_get_field($stmt, 1);
        $id = sqlsrv_get_field($stmt, 2);
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
        return $eventName;
    }
}

function multi_event_info_id($eventId) {
    echo "model.multi_event_info<br>";
    $conn = db();
    $sql = "SELECT S.TANFMultipleSessionEventID
        , E.EventName
        , S.MultipleSessionEventSessionID
        , S.StartDate
      FROM beta_torresmartinez.TANFMultipleSessionEventModule.TANFMultipleSessionEvent AS E
      JOIN beta_torresmartinez.TANFMultipleSessionEventModule.MultipleSessionEventSession AS S
      ON (S.TANFMultipleSessionEventID = E.TANFMultipleSessionEventID)
      WHERE S.TANFMultipleSessionEventID = " . $eventId .
            "AND   DATEPART(yyyy, StartDate) = " . date('Y') .
            "AND   DATEPART(mm, StartDate) = " . date('m') .
            "AND   DATEPART(dd, StartDate) = " . date('d');
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        echo "Error in query preparation/execution.\n";
        die(print_r(sqlsrv_errors(), true));
    }elseif (sqlsrv_fetch($stmt) === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        echo "model.multi_event_info after if false<br>";
        $id = sqlsrv_get_field($stmt, 2);
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
        return $id;
    }
}

function client_login($clientLastName, $clientSSN) {
    echo "model.client_login<br>";
    echo $clientLastName . "<br>";
    echo $clientSSN . "<br>";
    $conn = db();
    $sql = "SELECT P.[LastName]
, P.[FirstName]
, S.[PersonID]
, H.[HouseholdID]
, S.[SSN]
FROM [beta_torresmartinez].[PersonModule].[Person] P
JOIN [beta_torresmartinez].[PersonSSNModule].[Person] S
ON P.[PersonID] = S.[PersonID]
JOIN [beta_torresmartinez].[HouseholdModule].[HouseholdMember] H
ON P.[PersonID] = H.[PersonID]
WHERE RIGHT(SSN, 4) = " . $clientSSN;
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        echo "Error in query preparation/execution.\n";
        die(print_r(sqlsrv_errors(), true));
    }
    if (sqlsrv_fetch($stmt) === false) { // Make the first (and in this case, only) row of the result set available for reading.
        die(print_r(sqlsrv_errors(), true));
    }
    $dbClientLastName = sqlsrv_get_field($stmt, 0);
    $dbClientFirstName = sqlsrv_get_field($stmt, 1);
    $dbPersonId = sqlsrv_get_field($stmt, 2);
    $dbHouseholdId = sqlsrv_get_field($stmt, 3);
    if ($clientLastName == $dbClientLastName) {
        //echo "THEY MATCH THEY MATCH!!!!!!!!";
        $_SESSION["dbHouseholdId"] = $dbHouseholdId;
    }
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
    return;
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
    if ($stmt === false) {
        echo "Error in query preparation/execution.\n";
        die(print_r(sqlsrv_errors(), true));
    }
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        echo ("<input type = 'checkbox' name = 'clientAttended[]' value = " . $row['PersonID'] . " maxlength = '3'/> " . $row['FirstName'] . " " . $row['LastName'] . "<br>");
    }
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
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
    return;
}
