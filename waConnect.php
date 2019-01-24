<?php
 echo "inside waConnect </br>";
/* Specify the server and connection string attributes. */
//$serverName = "DESKTOP-LF2D9SR\SQLEXPRESS"; //HOME
$serverName = "TH-B03-VMWKS07\SQLEXPRESS";  //WORK
$connectionInfo = array("Database" => "beta_torresmartinez");
/* Connect using Windows Authentication. */
$conn = sqlsrv_connect($serverName, $connectionInfo);
if ($conn === false) {
    echo "Unable to connect";
    die(print_r(sqlsrv_errors(), true));
}
/* Query SQL Server for the login of the user accessing the
  database. */
$tsql = "SELECT CONVERT(varchar(32), SUSER_SNAME())";
$stmt = sqlsrv_query($conn, $tsql);
if ($stmt === false) {
    echo "Error in executing query.</br>";
    die(print_r(sqlsrv_errors(), true));
}
/* Retrieve and display the results of the query. */
$row = sqlsrv_fetch_array($stmt);
echo "User login: " . $row[0] . "</br>";
/* Free statement and connection resources. */
//sqlsrv_free_stmt($stmt);
//sqlsrv_close($conn);
?>