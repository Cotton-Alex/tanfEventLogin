<?php

//http://php.net/manual/en/ref.sqlsrv.php
//require('waConnect.php');

function staff_login($lastName, $idNumber) {
    echo "inside staff_login function</br>";
    echo "lastName = " . $lastName . " and idNumber = " . $idNumber . "</br>";
    $serverName = "TH-B03-VMWKS07\SQLEXPRESS";  //WORK
    $connectionInfo = array("Database" => "beta_torresmartinez");
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    //require ('waConnect.php');
//    echo "</br>";
//    echo $conn;
//    echo "</br>";
//    echo $serverName;
    $sql = "SELECT [StaffID]
        ,[FirstName]
        ,[LastName]
        FROM [beta_torresmartinez].[StaffModule].[Staff]
        WHERE [StaffID] = 4";
    //WHERE [StaffID] = " . $idNumber;
    $stmt = sqlsrv_query($conn, $sql);
    echo "</br>";
    echo $sql;
    echo "</br>";
    echo $stmt;
    if ($stmt == false) {
        echo "Error in query preparation/execution.\n";
        die(print_r(sqlsrv_errors(), true));
    }
    sqlsrv_close( $conn );
//    $name = sqlsrv_get_field($stmt, 0);
//    echo "$name: ";
//    $comment = sqlsrv_get_field($stmt, 1);
//    echo $comment;
}
