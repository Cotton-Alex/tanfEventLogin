<!DOCTYPE html>
<?php require('waConnect.php'); ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <!--        <form>
                    <input type="button" onclick="personInfo()"/>
                </form>-->
        <?php
        /* Set up and execute the query. */
        $tsql = "SELECT [PersonID]
      ,[FirstName]
      ,[MiddleName]
      ,[LastName]
      ,[Suffix]
      ,[DateOfBirth]
      ,[DateOfDeath]
      ,[Active]
      ,[Prefix]
       FROM [beta_torresmartinez].[PersonModule].[Person]
       WHERE [PersonID] = 29";

        $stmt = sqlsrv_query($conn, $tsql);
        if ($stmt === false) {
            echo "Error in query preparation/execution.\n";
            die(print_r(sqlsrv_errors(), true));
        }

        /* Retrieve each row as an associative array and display the results. */
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            echo $row['LastName'] . ", " . $row['FirstName'] . "\n";
        }

        /* Free statement and connection resources. */
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
        ?>
    </body>
</html>
