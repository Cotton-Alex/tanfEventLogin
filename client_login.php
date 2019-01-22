<?php session_start() ?>
<!DOCTYPE html>
<html>
    <head>
        <?php require('head.php');?>
        <title></title>
    </head>
    <body>
        <?php require('header.php');?>



        <form>
            <input type="text" 
            <input type="button" onclick="personInfo()"/>
        </form>
        <?php
        require('waConnect.php');
        $tsql = "SELECT P.[LastName]
                ,P.[FirstName]
                  FROM [beta_torresmartinez].[PersonModule].[Person] P
                  JOIN [beta_torresmartinez].[PersonSSNModule].[Person] S
                  ON P.[PersonID] = S.[PersonID]
                  WHERE RIGHT(SSN,4) = 4513";

        $stmt = sqlsrv_query($conn, $tsql);
        if ($stmt === false) {
            echo "Error in query preparation/execution.\n";
            die(print_r(sqlsrv_errors(), true));
        }

        /* Retrieve each row as an associative array and display the results. */
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            echo "Welcome " . $row['FirstName'] . " " . $row['LastName'] . "\n";
        }

        /* Free statement and connection resources. */
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
        ?>
    </body>
</html>
