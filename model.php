<?php
//http://php.net/manual/en/ref.sqlsrv.php
//require('waConnect.php');

function staff_login($lastName, $idNumber) {
    echo "inside staff_login function</br>";
    require('waConnect.php');
    $tsql = "SELECT [StaffID]
            ,[FirstName]
            ,[LastName]
            FROM [beta_torresmartinez].[StaffModule].[Staff]
            WHERE [StaffID] = " . $idNumber;
    echo $tsql;
    $stmt = sqlsrv_query($conn, $tsql);
    echo $tsql;
    if ($stmt == false) {
        echo "Error in query preparation/execution.\n";
        die(print_r(sqlsrv_errors(), true));
    }
}
