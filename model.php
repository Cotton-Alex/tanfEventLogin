<?php

//http://php.net/manual/en/ref.sqlsrv.php
//require('waConnect.php');

function staff_login($lastName, $idNumber) {
    $serverName = "TH-B03-VMWKS07\SQLEXPRESS";  //WORK
    $connectionInfo = array("Database" => "beta_torresmartinez");
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    if ($conn === false) {
        echo "Conn error\n";
        die(print_r(sqlsrv_errors(), true));
    }
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
    if (sqlsrv_fetch($stmt) === false) { // Make the first (and in this case, only) row of the result set available for reading.
        die(print_r(sqlsrv_errors(), true));
    }
    $id = sqlsrv_get_field($stmt, 0);
    $firstName = sqlsrv_get_field($stmt, 1);
    $dbLastName = sqlsrv_get_field($stmt, 2);
    
    if ($lastName === $dbLastName) {
        include ('event_login.php');
    }
    
    sqlsrv_close($conn);
}
