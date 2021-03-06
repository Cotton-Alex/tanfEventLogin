<?php

function db() {
    //echo "<br>debug enter m.db<br>";
    // TODO: Is there a more secure way to connect to the db?
    $serverName = "DESKTOP-LF2D9SR\SQLEXPRESS"; //HOME
    //$serverName = "TH-B03-VMWKS07\SQLEXPRESS";  //WORK
    $connectionInfo = array("Database" => "beta_torresmartinez");
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    if ($conn === false) {
        echo "Database connection error\n";
        die(print_r(sqlsrv_errors(), true));
    }
    return $conn;
}

function staff_login($idNumber) {
    //echo "<br>debug enter m.staffLogin";
    $conn = db();
    $sql = "SELECT [LastName]
        FROM [StaffModule].[Staff]
        WHERE [StaffID] = " . $idNumber .
            "AND ([Active] IS NULL OR [Active] = 1)";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        echo "Error in query preparation/execution.\n";
        die(print_r(sqlsrv_errors(), true));
    } if (sqlsrv_fetch($stmt) === false) {
        echo "Error in fetch preparation/execution.\n";
        die(print_r(sqlsrv_errors(), true));
    }
    $dbStaffLastName = sqlsrv_get_field($stmt, 0);
    //echo "<br>debug enter m.staffLogin dbStaffLastName = " . $dbStaffLastName;
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
    return $dbStaffLastName;
}

function single_event_info($eventId) {
    //echo "<br>debug enter m.single_event_info_id";
    //echo "<br>debug m.single_event_info_id eventId = " . $eventId;
    $conn = db();
    $sql = "SELECT [TANFOneTimeEventManagementID] 
        ,[EventName]
        ,[EventDate]
        FROM [TANFOneTimeEventManagementModule].[TANFOneTimeEventManagement]
        WHERE [TANFOneTimeEventManagementID] = " . $eventId .
            " AND   DATEPART(yyyy, EventDate) = " . date('Y') .
            " AND   DATEPART(mm, EventDate) = " . date('m') .
            " AND   DATEPART(dd, EventDate) = " . date('d');
    //echo "<br>debug m.single_event_info_id sql = " . $sql;
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        echo "Error in query preparation/execution.\n";
        die(print_r(sqlsrv_errors(), true));
    }
    if (sqlsrv_fetch($stmt) === false) {
        echo "Error in fetch preparation/execution.\n";
        die(print_r(sqlsrv_errors(), true));
    }
    $id = sqlsrv_get_field($stmt, 0);
    $eventName = sqlsrv_get_field($stmt, 1);
    $singleEventInfo = array($id, $eventName);
    //echo "<br>debug m.single_event_info_id id = " . $id;
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
    return $singleEventInfo;
}

function multi_event_info($eventId) {
    //echo "<br>debug enter m.multi_event_info";
    //echo "<br>debug m.multi_event_info eventId = " . $eventId;
    $conn = db();
    $sql = "SELECT S.TANFMultipleSessionEventID
        , E.EventName
        , S.MultipleSessionEventSessionID
        , S.StartDate
        FROM TANFMultipleSessionEventModule.TANFMultipleSessionEvent AS E
        JOIN TANFMultipleSessionEventModule.MultipleSessionEventSession AS S
        ON (S.TANFMultipleSessionEventID = E.TANFMultipleSessionEventID)
        WHERE S.TANFMultipleSessionEventID = " . $eventId .
            "AND   DATEPART(yyyy, StartDate) = " . date('Y') .
            "AND   DATEPART(mm, StartDate) = " . date('m') .
            "AND   DATEPART(dd, StartDate) = " . date('d');
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        echo "Error in query preparation/execution.\n";
        die(print_r(sqlsrv_errors(), true));
    } if (sqlsrv_fetch($stmt) === false) {
        echo "Error in fetch preparation/execution.\n";
        die(print_r(sqlsrv_errors(), true));
    }
    //echo "<br>debug m.multi_event_info after ifs";
    $multiSessionEventId = sqlsrv_get_field($stmt, 0);
    $eventName = sqlsrv_get_field($stmt, 1);
    $id = sqlsrv_get_field($stmt, 2);
    $multiSessionEventInfo = array($multiSessionEventId, $eventName, $id);
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
    return $multiSessionEventInfo;
}

function client_login($clientSSN) {
    //echo "<br>debug enter m.client_login";
    //echo "<br>debug m.client_login clientSSN = " . $clientSSN;
    $conn = db();
    $sql = "SELECT P.[LastName]
        , P.[FirstName]
        , S.[PersonID]
        , H.[HouseholdID]
        , S.[SSN]
        FROM [PersonModule].[Person] P
        JOIN [PersonSSNModule].[Person] S
        ON P.[PersonID] = S.[PersonID]
        JOIN [HouseholdModule].[HouseholdMember] H
        ON P.[PersonID] = H.[PersonID]
        WHERE RIGHT(SSN, 4) = " . $clientSSN;
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        echo "Error in query preparation/execution.\n";
        die(print_r(sqlsrv_errors(), true));
    }
    if (sqlsrv_fetch($stmt) === false) { // Make the first (and in this case, only) row of the result set available for reading.
        echo "Error in fetch preparation/execution.\n";
        die(print_r(sqlsrv_errors(), true));
    }
    $dbClientLastName = sqlsrv_get_field($stmt, 0);
    $dbClientFirstName = sqlsrv_get_field($stmt, 1);
    $dbPersonId = sqlsrv_get_field($stmt, 2);
    $dbHouseholdId = sqlsrv_get_field($stmt, 3);
    $clientInfoArray = array($dbClientLastName, $dbClientFirstName, $dbPersonId, $dbHouseholdId);
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
    return $clientInfoArray;
}

function get_household_members($dbHouseholdId) {
    $conn = db();
    $sql = "SELECT P.[LastName]
        , P.[FirstName]
        , P.[PersonID]
        FROM [PersonModule].[Person] P
        JOIN [HouseholdModule].[HouseholdMember] H
        ON P.[PersonID] = H.[PersonID]
        WHERE [HouseholdID] = " . $dbHouseholdId;
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        echo "Error in query preparation/execution.\n";
        die(print_r(sqlsrv_errors(), true));
    }
    //$dbHouesholeMembers = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        echo ("<input class='checkbox attendance_form_input' type = 'checkbox' name = 'clientAttended[]' value = " . $row['PersonID'] . " maxlength = '3'/>" . $row['FirstName'] . " " . $row['LastName']);
//        echo ("<p class='checkbox_names'>" . $row['FirstName'] . " " . $row['LastName'] . "</p>");
    }
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
    //return $dbHouesholeMembers;
    return;
}

function get_all_household_members($dbHouseholdId) {
    $conn = db();
    $sql = "SELECT *
        FROM [PersonModule].[Person] P
        JOIN [HouseholdModule].[HouseholdMember] H
        ON P.[PersonID] = H.[PersonID]
        WHERE [HouseholdID] = " . $dbHouseholdId;
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        echo "Error in query preparation/execution.\n";
        die(print_r(sqlsrv_errors(), true));
    }
    echo $stmt;
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
    return;
}

function one_Time_Event_Update_Attendance_No_Duplicates($sessionEventId, $attendeeId) {
    $conn = db();
    $sql = "IF NOT EXISTS (SELECT [TANFOneTimeEventManagementID], [RegistrantID]
	FROM [TANFOneTimeEventManagementModule].[OneTimeEventRegistrant]
	WHERE [TANFOneTimeEventManagementID] = " . $sessionEventId . " AND [RegistrantID] = " . $attendeeId . ")
INSERT INTO [TANFOneTimeEventManagementModule].[OneTimeEventRegistrant] (TANFOneTimeEventManagementID, RegistrantID, Attended)
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

function multi_Event_Update_Attendance_No_Duplicates($sessionEventId, $attendeeId) {
    $conn = db();
    $sql = "IF NOT EXISTS (SELECT [MultipleSessionEventSessionID], [PersonID]
	FROM [TANFMultipleSessionEventModule].[MultipleSessionEventSessionAttendee]
	WHERE [MultipleSessionEventSessionID] = " . $sessionEventId . " AND [PersonID] = " . $attendeeId . ")
INSERT INTO [TANFMultipleSessionEventModule].[MultipleSessionEventSessionAttendee] (MultipleSessionEventSessionID, PersonID, Attended) 
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

function one_Time_Event_Attendee_Count($sessionEventId) {
    //echo "<br>debug enter m.one_Time_Event_Attendee_Count";
    //echo "<br>debug m.one_Time_Event_Attendee_Count eventId = " . $eventId;
    $conn = db();
    $sql = "SELECT *
        FROM [TANFOneTimeEventManagementModule].[OneTimeEventRegistrant] R
        JOIN [TANFOneTimeEventManagementModule].[TANFOneTimeEventManagement] N
        ON R.[TANFOneTimeEventManagementID] = N.[TANFOneTimeEventManagementID]
        WHERE N.[TANFOneTimeEventManagementID] = " . $sessionEventId .
            " AND R.[Attended] = 1" .
            " AND   DATEPART(yyyy, EventDate) = " . date('Y') .
            " AND   DATEPART(mm, EventDate) = " . date('m') .
            " AND   DATEPART(dd, EventDate) = " . date('d');
    $stmt = sqlsrv_query($conn, $sql, array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET));
    if ($stmt === false) {
        echo "Error in query preparation/execution.\n";
        die(print_r(sqlsrv_errors(), true));
    }
    $attendanceCount = sqlsrv_num_rows($stmt);
    if ($attendanceCount === false) {
        $attendanceCount = 0;
    } else {
        //echo "<br>debug m.one_Time_Event_Attendee_Count after ifs";
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
        return $attendanceCount;
    }
}

function multi_Event_Attendee_Count($sessionEventId) {
    //echo "<br>debug enter m.one_Time_Event_Attendee_Count";
    //echo "<br>debug m.one_Time_Event_Attendee_Count eventId = " . $eventId;
    $conn = db();
    $sql = "SELECT M.[TANFMultipleSessionEventID]
    ,M.[EventName]
    ,S.[MultipleSessionEventSessionID]
    ,S.[StartDate]
    ,A.[PersonID]
    ,P.[FirstName]
    ,P.[LastName]
    ,A.[Attended]
    FROM [TANFMultipleSessionEventModule].[TANFMultipleSessionEvent] M
    JOIN [TANFMultipleSessionEventModule].[MultipleSessionEventSession] S
    ON M.[TANFMultipleSessionEventID] = S.[TANFMultipleSessionEventID]
    JOIN [TANFMultipleSessionEventModule].[MultipleSessionEventSessionAttendee] A
    ON S.[MultipleSessionEventSessionID] = A.[MultipleSessionEventSessionID]
    JOIN [PersonModule].[Person] P
    ON A.[PersonID] = P.[PersonID]
        WHERE A.[MultipleSessionEventSessionID] = " . $sessionEventId .
            " AND A.[Attended] = 1" .
            " AND   DATEPART(yyyy, StartDate) = " . date('Y') .
            " AND   DATEPART(mm, StartDate) = " . date('m') .
            " AND   DATEPART(dd, StartDate) = " . date('d');
    $stmt = sqlsrv_query($conn, $sql, array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET));
    if ($stmt === false) {
        echo "Error in query preparation/execution.\n";
        die(print_r(sqlsrv_errors(), true));
    }
    $attendanceCount = sqlsrv_num_rows($stmt);
    if ($attendanceCount === false) {
        $attendanceCount = 0;
    } else {
        //echo "<br>debug m.one_Time_Event_Attendee_Count after ifs";
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
        return $attendanceCount;
    }
}

function get_one_Time_Event_Attendee_List($sessionEventId) {
    //echo "<br>debug enter m.get_one_Time_Event_Attendee_List";
    //echo "<br>debug m.get_one_Time_Event_Attendee_List eventId = " . $eventId;
    $conn = db();
    $sql = "SELECT R.[OneTimeEventRegistrantID]
      ,R.[TANFOneTimeEventManagementID]
      ,N.[EventName]
      ,N.[EventDate]
      ,R.[RegistrantID]
      ,P.[FirstName]
      ,P.[LastName]
      ,R.[Attended]
        FROM [beta_torresmartinez].[TANFOneTimeEventManagementModule].[OneTimeEventRegistrant] R
        JOIN [beta_torresmartinez].[PersonModule].[Person] P
        ON R.[RegistrantID] = P.[PersonID]
        JOIN [beta_torresmartinez].[TANFOneTimeEventManagementModule].[TANFOneTimeEventManagement] N
        ON R.[TANFOneTimeEventManagementID] = N.[TANFOneTimeEventManagementID]
        WHERE N.[TANFOneTimeEventManagementID] = " . $sessionEventId .
            " AND R.[Attended] = 1" .
            " AND   DATEPART(yyyy, EventDate) = " . date('Y') .
            " AND   DATEPART(mm, EventDate) = " . date('m') .
            " AND   DATEPART(dd, EventDate) = " . date('d');
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        echo "Error in query preparation/execution.\n";
        die(print_r(sqlsrv_errors(), true));
    } else {
        //echo "<br>debug m.get_one_Time_Event_Attendee_List after ifs";
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            echo ("<p class='attendee_list'> " . $row['FirstName'] . " " . $row['LastName']);
        }
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
        return;
    }
}

function get_multi_Event_Attendee_List($sessionEventId) {
    //echo "<br>debug enter m.get_one_Time_Event_Attendee_List";
    //echo "<br>debug m.get_one_Time_Event_Attendee_List eventId = " . $eventId;
    $conn = db();
    $sql = "SELECT M.[TANFMultipleSessionEventID]
    ,M.[EventName]
    ,S.[MultipleSessionEventSessionID]
    ,S.[StartDate]
    ,A.[PersonID]
    ,P.[FirstName]
    ,P.[LastName]
    ,A.[Attended]
    FROM [TANFMultipleSessionEventModule].[TANFMultipleSessionEvent] M
    JOIN [TANFMultipleSessionEventModule].[MultipleSessionEventSession] S
    ON M.[TANFMultipleSessionEventID] = S.[TANFMultipleSessionEventID]
    JOIN [TANFMultipleSessionEventModule].[MultipleSessionEventSessionAttendee] A
    ON S.[MultipleSessionEventSessionID] = A.[MultipleSessionEventSessionID]
    JOIN [PersonModule].[Person] P
    ON A.[PersonID] = P.[PersonID]
        WHERE A.[MultipleSessionEventSessionID] = " . $sessionEventId .
            " AND A.[Attended] = 1" .
            " AND   DATEPART(yyyy, StartDate) = " . date('Y') .
            " AND   DATEPART(mm, StartDate) = " . date('m') .
            " AND   DATEPART(dd, StartDate) = " . date('d');
    $stmt = sqlsrv_query($conn, $sql, array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET));
    if ($stmt === false) {
        echo "Error in query preparation/execution.\n";
        die(print_r(sqlsrv_errors(), true));
    }
    $attendanceCount = sqlsrv_num_rows($stmt);
    if ($attendanceCount === false) {
        $attendanceCount = 0;
    } else {
        //echo "<br>debug m.one_Time_Event_Attendee_Count after ifs";
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
        return $attendanceCount;
    }
}

//function get_all_attendees_list($dbHouseholdId) {
//    $conn = db();
//    $sql = "SELECT *
//        FROM [PersonModule].[Person] P
//        JOIN [HouseholdModule].[HouseholdMember] H
//        ON P.[PersonID] = H.[PersonID]
//        WHERE [HouseholdID] = " . $dbHouseholdId;
//    $stmt = sqlsrv_query($conn, $sql);
//    if ($stmt === false) {
//        echo "Error in query preparation/execution.\n";
//        die(print_r(sqlsrv_errors(), true));
//    }
//    echo $stmt;
//    sqlsrv_free_stmt($stmt);
//    sqlsrv_close($conn);
//    return;
//}