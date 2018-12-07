<?php

/* Specify the server and connection string attributes. */
$serverName = "DESKTOP-LF2D9SR\SQLEXPRESS";
$connectionInfo = array("Database" => "beta_torresmartinez");
/* Connect using Windows Authentication. */
$conn = sqlsrv_connect($serverName, $connectionInfo);
if ($conn === false) {
    echo "Unable to connect.</br>";
    die(print_r(sqlsrv_errors(), true));
}

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